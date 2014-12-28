<?php

namespace Zorbus\LinkedIn;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\Response;
use Zorbus\LinkedIn\Client\ClientInterface;
use Zorbus\LinkedIn\Serializer\SerializerInterface;
use Zorbus\LinkedIn\Storage\StorageInterface;

class Manager
{
    const STATE_KEY = 'zorbus_linkedin_state';
    const ACCESS_TOKEN = 'zorbus_linkedin_access_token';
    const EXPIRES_IN = 'zorbus_linkedin_expires_in';

    private $key = null;
    private $redirectUrl = null;

    private $client;
    private $storage;
    private $serializer;

    public function __construct(ClientInterface $client, StorageInterface $storage, SerializerInterface $serializer = null)
    {
        $this->client = $client;
        $this->storage = $storage;
        $this->serializer = $serializer;
    }

    /**
     * @param $key string
     * @param array $permissions
     * @param $redirectUrl string
     */
    public function authorize($key, array $scope, $redirectUrl)
    {
        $state = uniqid(rand(100, 200) . rand(150, 600));
        $this->storage->store(self::STATE_KEY, $state);

        $this->key = $key;
        $this->redirectUrl = $redirectUrl;

        $url = sprintf(
            'https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=%s&scope=%s&state=%s&redirect_uri=%s',
            $key,
            urlencode(implode(' ', $scope)),
            $state,
            urlencode($redirectUrl)
        );

        header('Location: ' . $url);
        exit();
    }

    /**
     * @param string $code the query parameter sent by LinkedId
     * @param string $state string the query parameter sent by LinkedIn
     * @param string $secret string the application secret registered on LinkedIn
     * @param null $key the application key registered on LinkedIn
     * @param null $redirectUrl
     * @return array Returns array with keys access_token and expires_in
     */
    public function authenticate($code, $state, $secret, $key = null, $redirectUrl = null)
    {
        if ($state !== $this->storage->retrieve(self::STATE_KEY)) {
            $message = sprintf('State %s does not match the saved state %s.', $state, $this->storage->retrieve(self::STATE_KEY));
            throw new \RuntimeException($message);
        } else {
            $this->storage->remove(self::STATE_KEY);
        }

        $url = 'https://www.linkedin.com/uas/oauth2/accessToken';
        $parameters = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUrl,
            'client_id' => $key,
            'client_secret' => $secret
        ];

        try {
            $response = $this->client->call($url, ClientInterface::METHOD_POST, $parameters);

            if ($response instanceof Response) {
                $data = json_decode($response->getBody()->getContents(), true);

                if (!array_key_exists('access_token', $data) || !array_key_exists('expires_in', $data)) {
                    throw new \LogicException('Missing at least one of the keys: access_token or expires_in', 500);
                }
            } else {
                throw new \LogicException('Unexpected response', 500);
            }
        } catch (ClientException $e) {
            throw new \RuntimeException('Invalid response', 500, $e);
        }

        return $data;
    }

    /**
     * @param array $fields
     * @return \Zorbus\LinkedIn\Model\Profile
     */
    public function getProfile(array $fields = null, $model = null)
    {
        $fields = null === $fields ?
            '' :
            ':(' . implode(',', $fields) . ')';

        $uri = '/people/~' . $fields;

        return $this->execute($uri, $model);
    }

    /**
     * @param array $fields
     * @return array
     */
    public function getCertifications(array $fields = null, $model = null)
    {
        $fields = null === $fields ?
            '' :
            ':(' . implode(',', $fields) . ')';

        $uri = '/people/~:(certifications' . $fields.')';

        return $this->execute($uri, $model);
    }

    protected function execute($uri, $model = null, $method = ClientInterface::METHOD_GET, $parameters = [], $headers = [])
    {
        $data = null;

        if (!array_key_exists('Authorization', $headers)) {
            $accessToken = $this->storage->retrieve(self::ACCESS_TOKEN);

            if (!$accessToken){
                throw new \LogicException('No access token available for authentication');
            }

            $this->client->setAuthorization($accessToken);
        }

        /** @var \GuzzleHttp\Message\Response $response */
        $data = $this->client->call($uri, $method, $parameters, $headers);

        // ToDO: Client should always return a consistent Response object, not rely on Guzzle
        if ($data instanceof Response) {
            $data = (string)$data->getBody()->getContents();
        }

        if (null !== $model && $this->serializer instanceof SerializerInterface) {
            $data = $this->serializer->deserialize($data, $model, 'json');
        } else {
            $data = json_decode($data, true);
        }

        return $data;
    }
}