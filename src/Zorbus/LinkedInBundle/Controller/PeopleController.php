<?php

namespace Zorbus\LinkedInBundle\Controller;

use GuzzleHttp\Message\Response as GuzzleResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zorbus\LinkedInBundle\Event\LinkedInTokenEvent;
use DateTime;

class PeopleController extends Controller
{
    public function profileAction()
    {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus_linkedin.manager.api');

        $profile = $manager->getProfile([
            'id',
            'first-name',
            'last-name',
            'headline',
            'summary',
            'specialties',
            'positions',
            'picture-url',
            'public-profile-url',
            'interests',
            'languages',
            'skills',
            'certifications',
            'educations',
            'courses',
        ]);

        return $profile;
    }

    public function certificationsAction() {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus_linkedin.manager.api');

        $profile = $manager->getCertifications([
            'id',
            'name',
            'number',
            'authority',
            'start-date',
            'end-date',
        ]);

        return $profile;
    }
}