<?php

namespace Sportlobster\ApiBundle\Model;

class User
{

    protected $username;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    protected $firstName;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFullName()
    {
        return $this->getUsername() . ': ' . $this->getFirstName();
    }

}
