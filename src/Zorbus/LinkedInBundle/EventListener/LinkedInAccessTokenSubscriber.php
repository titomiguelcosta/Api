<?php

namespace Zorbus\LinkedInBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Zorbus\LinkedIn\Manager;
use Zorbus\LinkedIn\Storage\StorageInterface;
use Zorbus\LinkedInBundle\Event\LinkedInTokenEvent;

class LinkedInAccessTokenSubscriber implements EventSubscriberInterface
{
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function onAccessToken(LinkedInTokenEvent $event)
    {
        $this->storage->store(Manager::ACCESS_TOKEN, $event->getAccessToken());
        $this->storage->store(Manager::EXPIRES_IN, $event->getExpiresAt()->format('Y-m-d H:i:s'));
    }

    public static function getSubscribedEvents()
    {
        return ['zorbus_linkedin.access_token' => [['onAccessToken']]];
    }
}