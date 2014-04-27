<?php

namespace Sportlobster\ApiBundle\Model;

use Sportlobster\ApiBundle\Entity\User as UserEntity;

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

    public function toArray($type = self::COMPLETE)
    {
        return array(
            'username' => $this->getUsername()
        );
    }

    public static function createFromEntity(UserEntity $userEntity)
    {
        $userModel = new static();
        $userModel->setUsername($userEntity->getUsername());
        return $userModel;
    }

}
