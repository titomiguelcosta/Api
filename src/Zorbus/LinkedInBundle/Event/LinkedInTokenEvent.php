<?php

namespace Zorbus\LinkedInBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use DateTime;

class LinkedInTokenEvent extends Event
{
    private $accessToken;
    private $expiresAt;

    public function __construct($accessToken, DateTime $expiredAt)
    {
        $this->accessToken = $accessToken;
        $this->expiresAt = $expiredAt;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
}