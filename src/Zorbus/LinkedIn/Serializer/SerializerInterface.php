<?php

namespace Zorbus\LinkedIn\Serializer;

interface SerializerInterface
{
    public function deserialize($data, $class, $format);
}