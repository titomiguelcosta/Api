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
        $object = $this->entityManager->getRepository('ZorbusLinkedInBundle:Storage')->findOneBy([
            'field' => $key
        ]);

        return $object instanceof Storage;
    }

    public function store($key, $value)
    {
        $entry = new Storage();
        $entry->setField($key);
        $entry->setValue($value);

        $this->entityManager->persist($entry);
        $this->entityManager->flush();
    }

    public function retrieve($key)
    {
        $object = $this->entityManager->getRepository('ZorbusLinkedInBundle:Storage')->findOneBy([
            'field' => $key
        ]);

        return $object;
    }

    public function remove($key)
    {
        $object = $this->retrieve($key);

        if ($object instanceof Storage) {
            $this->entityManager->remove($object);
            $this->entityManager->flush();
        }
    }

}