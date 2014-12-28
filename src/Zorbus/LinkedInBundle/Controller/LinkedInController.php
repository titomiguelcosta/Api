<?php

namespace Zorbus\LinkedInBundle\Controller;

use GuzzleHttp\Message\Response as GuzzleResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zorbus\LinkedInBundle\Event\LinkedInTokenEvent;
use DateTime;

class LinkedInController extends Controller
{
    public function authorizeAction(Request $request)
    {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus_linkedin.manager');

        $key = $this->container->getParameter('zorbus_linkedin.key');
        $scope = $this->container->getParameter('zorbus_linkedin.scope');
        $url = $this->generateUrl('zorbus_linkedin.authenticate', [], true);

        $manager->authorize($key, $scope, $url);
    }

    public function authenticateAction(Request $request)
    {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus_linkedin.manager');

        $code = $request->query->get('code');
        $state = $request->query->get('state');
        $secret = $this->container->getParameter('zorbus_linkedin.secret');
        $key = $this->container->getParameter('zorbus_linkedin.key');
        $redirectUrl = $this->generateUrl('zorbus_linkedin.authenticate', [], true);

        $data = $manager->authenticate($code, $state, $secret, $key, $redirectUrl);

        $event = new LinkedInTokenEvent($data['access_token'], new DateTime('+' . $data['expires_in'] . ' seconds'));

        $this->get('event_dispatcher')->dispatch('zorbus_linkedin.access_token', $event);

        return new Response('Retrieved access token. Ready to go.');
    }

    public function profileAction(Request $request)
    {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus_linkedin.manager');

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
}