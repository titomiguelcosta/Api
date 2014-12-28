<?php

namespace Zorbus\LinkedIn\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Stream\Stream;

class GuzzleClientAdapter implements ClientInterface
{
    private $client;
    private $headers = [];
    private $baseUrl = '';

    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    /**
     * @see https://developer.linkedin.com/documents/reading-data
     * @param $format
     */
    public function setResponseFormat($format)
    {
        switch ($format) {
            case 'json':
            case 'xml':
                $this->headers['x-li-format'] = $format;
                break;
            default:
                throw new \InvalidArgumentException('Invalid response format.');
        }
    }

    public function setAuthorization($code)
    {
        $this->headers['Authorization'] = 'Bearer ' . $code;
    }

    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;
    }

    public function call($uri, $method = self::METHOD_GET, array $parameters = [], array $headers = [], $body = '')
    {
        $request = $this->client->createRequest($method, $this->baseUrl . $uri);
        $request->setQuery($parameters);
        $request->setHeaders(array_merge($this->headers, $headers));
        $request->setBody(Stream::factory($body));

        try {
            return $this->client->send($request);
        } catch (ClientException $e) {
            throw new \RuntimeException("Invalid request to ".$this->baseUrl . $uri, 500, $e);
        }
    }
}