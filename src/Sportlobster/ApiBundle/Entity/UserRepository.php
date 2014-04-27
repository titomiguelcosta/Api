<?php

namespace Sportlobster\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Sportlobster\ApiBundle\Entity\User as UserEntity;

class UserRepository extends EntityRepository
{

    public function createUser($username)
    {
        $userEntity = new UserEntity();
        $userEntity->setUsername($username);

        $this->_em->persist($userEntity);
        $this->_em->flush();

        return $userEntity;
    }

}
