<?php

namespace Zorbus\ApiBundle\Manager;

use Zorbus\ApiBundle\Entity\UserRepository as UserEntityRepository;
use Doctrine\Common\Cache\Cache as CacheInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Zorbus\ApiBundle\Entity\User as UserEntity;
use Zorbus\ApiBundle\Cache\UserCacheConfiguration;

class UserManager
{

    protected $userEntityRepository;
    protected $cacheProvider;
    protected $cacheConfiguration;

    public function __construct(UserEntityRepository $userEntityRepository, CacheInterface $cache, UserCacheConfiguration $userCacheConfiguration)
    {
        $this->userEntityRepository = $userEntityRepository;
        $this->cacheProvider = $cache;
        $this->cacheConfiguration = $userCacheConfiguration;
    }

    public function getById($id)
    {
        $key = $this->cacheConfiguration->getUserKey($id);
        $userEntity = $this->cacheProvider->fetch($key);

        if (false === $userEntity) {
            $userEntity = $this->userEntityRepository->find($id);

            if (false === $userEntity instanceof UserEntity) {
                throw new NotFoundHttpException('User not found.');
            }

            $this->cacheProvider->save($key, $userEntity, $this->cacheConfiguration->getUserLifetime());
        }

        return $userEntity;
    }

    public function getByUsername($username)
    {
        $key = $this->cacheConfiguration->getUserKey($username);
        $userEntity = $this->cacheProvider->fetch($key);

        if (false === $userEntity) {
            $userEntity = $this->userEntityRepository->findOneByUsername($username);
            
            if (false === ($userEntity instanceof UserEntity)) {
                throw new NotFoundHttpException('User not found.');
            }
            
            $this->cacheProvider->save($key, $userEntity, $this->cacheConfiguration->getUserLifetime());
        }

        return $userEntity;
    }

}
