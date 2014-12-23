<?php

namespace Zorbus\LinkedIn\Serializer;

use JMS\Serializer\Serializer;

class JmsSerializer implements SerializerInterface
{
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function deserialize($data, $class, $format)
    {
        return $this->serializer->deserialize($data, $class, $format);
    }
}