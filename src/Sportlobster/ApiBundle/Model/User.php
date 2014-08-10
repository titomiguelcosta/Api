<?php

namespace Sportlobster\ApiBundle\Model;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{

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
