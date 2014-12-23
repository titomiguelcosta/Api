<?php

namespace Zorbus\LinkedIn\Storage;

use Symfony\Component\HttpFoundation\Session\Session;

class SymfonySessionAdapter implements StorageInterface
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function has($key)
    {
        return $this->session->has($key);
    }

    public function store($key, $value)
    {
        $this->session->set($key, $value);

        return $this;
    }

    public function retrieve($key)
    {
        return $this->session->get($key);
    }

    public function remove($key)
    {
        $this->session->remove($key);
    }
}