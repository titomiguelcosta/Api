<?php

namespace Zorbus\LinkedIn\Storage;

interface StorageInterface
{
    public function has($key);

    public function store($key, $value);

    public function retrieve($key);

    public function remove($key);
}