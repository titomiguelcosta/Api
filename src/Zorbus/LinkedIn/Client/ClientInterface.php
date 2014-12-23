<?php

namespace Zorbus\LinkedIn\Client;

interface ClientInterface
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    public function setResponseFormat($format);

    public function setAuthorization($code);

    public function setBaseUrl($url);

    public function call($uri, $method = self::METHOD_GET, array $parameters = [], array $headers = [], $body = '');
}