<?php

namespace Sportlobster\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Sportlobster\ApiBundle\Entity\User as UserEntity;
use Sportlobster\ApiBundle\Request\User\UserCreateRequest;

class UserRepository extends EntityRepository
{

    public function createFromUserCreateRequest(UserCreateRequest $userCreateRequest)
    {
        $userEntity = new UserEntity();
        $userEntity->setUsername($userCreateRequest->getUsername());

        $this->_em->persist($userEntity);
        $this->_em->flush();

        return $userEntity;
    }

}
