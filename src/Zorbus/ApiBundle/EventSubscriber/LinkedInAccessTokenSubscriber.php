<?php

namespace Zorbus\ApiBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Zorbus\LinkedInBundle\Event\LinkedInTokenEvent;

class LinkedInAccessTokenSubscriber implements EventSubscriberInterface
{

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        return [
            ['zorbus_linkedin.access_token', ['onLinkedInAccessToken']]
        ];
    }

    public function onLinkedInAccessToken(LinkedInTokenEvent $event)
    {
        $this->session->set('linkedin.access_token', $event->getAccessToken());
    }

}