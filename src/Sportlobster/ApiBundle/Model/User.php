<?php

namespace Sportlobster\ApiBundle\Model;

class User implements ModelInterface
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

    public function toArray($type = self::COMPLETE)
    {
        return array(
            'username' => $this->getUsername()
        );
    }

}
