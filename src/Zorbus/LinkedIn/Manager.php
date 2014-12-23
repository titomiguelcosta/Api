<?php

namespace Zorbus\LinkedIn;

use Zorbus\LinkedIn\Client\ClientInterface;
use Zorbus\LinkedIn\Storage\StorageInterface;

class Manager
{
    const STATE_KEY = 'zorbus_linkedin_state';

    private $key = null;
    private $redirectUrl = null;

    private $client;
    private $storage;

    public function __construct(ClientInterface $client, StorageInterface $storage)
    {
        $this->client = $client;
        $this->storage = $storage;
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
     * @param string $code the query parameter sent by LinkenId
     * @param string $state string the query parameter sent by LinkenIn
     * @param string $secret string the application secret registered on LinkendIn
     * @param null $key the application key registered on LinkedIn
     * @param null $redirectUrl
     * @return mixed
     */
    public function authenticate($code, $state, $secret, $key = null, $redirectUrl = null)
    {
        if ($state !== $this->storage->retrieve(self::STATE_KEY)) {
            $message = sprintf('State %s does not match the saved state %s.', $state, $this->storage->retrieve('state'));
            throw new \RuntimeException($message);
        } else {
            $this->storage->remove(self::STATE_KEY);
        }

        $url = sprintf(
            'https://www.linkedin.com/uas/oauth2/accessToken?grant_type=authorization_code&code=%s&redirect_uri=%s&client_id=%s&client_secret=%s',
            $code,
            $secret,
            urlencode($redirectUrl),
            $key
        );

        $response = $this->client->call($url, ClientInterface::METHOD_POST);

        return $response;
    }

    public function getProfile(array $fields = null)
    {
        $fields = null === $fields ?
            '' :
            ':(' . implode(',', $fields) . ')';

        $uri = '/people/~' . $fields;
        $method = ClientInterface::METHOD_GET;
        $parameters = [];
        $headers = [];

        $response = $this->client->call($uri, $method, $parameters, $headers);

        return $response;
    }
}