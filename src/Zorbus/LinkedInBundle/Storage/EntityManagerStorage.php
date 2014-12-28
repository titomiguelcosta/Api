<?php

namespace Zorbus\LinkedInBundle\Storage;

use Doctrine\ORM\EntityManagerInterface;
use Zorbus\LinkedIn\Storage\StorageInterface;
use Zorbus\LinkedInBundle\Entity\Storage;

class EntityManagerStorage implements StorageInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function has($key)
    {
        $object = $this->getStorageByField($key);

        return $object instanceof Storage;
    }

    public function store($key, $value)
    {
        if ($this->has($key)) {
            $this->remove($key);
        }

        $storage = new Storage();
        $storage->setField($key);
        $storage->setValue($value);

        $this->entityManager->persist($storage);
        $this->entityManager->flush();
    }

    public function retrieve($key)
    {
        $object = $this->getStorageByField($key);

        if (false === $object instanceof Storage) {
            throw new \LogicException('No storage entry for key ' . $key);
        }

        return $object->getValue();
    }

    public function remove($key)
    {
        $object = $this->getStorageByField($key);

        if ($object instanceof Storage) {
            $this->entityManager->remove($object);
            $this->entityManager->flush();
        }
    }

    private function getStorageByField($key)
    {
        $object = $this->entityManager->getRepository('ZorbusLinkedInBundle:Storage')->findOneBy([
            'field' => $key
        ]);

        return $object;
    }

}