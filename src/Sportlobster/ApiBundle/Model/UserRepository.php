<?php

namespace Sportlobster\ApiBundle\Model;

use Sportlobster\ApiBundle\Entity\UserRepository as UserEntityRepository;
use Doctrine\Common\Cache\Cache as CacheInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sportlobster\ApiBundle\Entity\User as UserEntity;
use Sportlobster\ApiBundle\Request\User\UserCreateRequest;
use Sportlobster\ApiBundle\Cache\UserCacheConfiguration;

class UserRepository
{

    protected $userEntityRepository;
    protected $cacheProvider;
    protected $cacheConfiguration;

    public function __construct(UserEntityRepository $userEntityRepository, CacheInterface $cache)
    {
        $this->userEntityRepository = $userEntityRepository;
        $this->cacheProvider = $cache;
        $this->cacheConfiguration = new UserCacheConfiguration();
    }

    public function getById($id)
    {
        $key = $this->cacheConfiguration->getUserKey($id);
        $userModel = $this->cacheProvider->fetch($key);

        if (false === $userModel) {
            $userEntity = $this->userEntityRepository->find($id);

            if (false === $userEntity instanceof UserEntity) {
                throw new NotFoundHttpException('User not found.');
            }

            $userModel = User::createFromEntity($userEntity);

            $this->cacheProvider->save($key, $userModel, $this->cacheConfiguration->getUserLifetime());
        }

        return $userModel;
    }

    public function createFromUserCreateRequest(UserCreateRequest $userCreateRequest)
    {
        $userEntity = $this->userEntityRepository->createUser($userCreateRequest->getUsername());

        return $userEntity;
    }

}
