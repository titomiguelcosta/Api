<?php

namespace Zorbus\ApiBundle\Model;

class Blog extends Article
{

    protected $user;

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

}
