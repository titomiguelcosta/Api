<?php

namespace Zorbus\LinkedInBundle\Controller;

use GuzzleHttp\Message\Response as GuzzleResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zorbus\LinkedInBundle\Event\LinkedInTokenEvent;

class LinkedInController extends Controller
{
    /**
     * @Route("/authorize", name="zorbus.linkedin.authorize")
     * @Method({"GET"})
     */
    public function authorizeAction(Request $request)
    {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus_linkedin.manager');

        $key = $this->container->getParameter('zorbus_linkedin.key');
        $scope = $this->container->getParameter('zorbus_linkedin.scope');
        $url = $this->generateUrl('zorbus_linkedin.authenticate', [], true);

        $manager->authorize($key, $scope, $url);
    }

    /**
     * @Route("/authenticate", name="zorbus.linkedin.authenticate")
     * @Method({"GET", "POST"})
     */
    public function authenticateAction(Request $request)
    {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus_linkedin.manager');

        $code = $request->query->get('code');
        $state = $request->query->get('state');
        $secret = $this->container->getParameter('zorbus_linkedin.secret');
        $key = $this->container->getParameter('zorbus_linkedin.key');
        $redirectUrl = $this->generateUrl('zorbus_linkedin.authenticate', [], true);

        $response = $manager->authenticate($code, $state, $secret, $key, $redirectUrl);

        if ($response instanceof GuzzleResponse) {
            $data = json_encode($response->getBody()->getContents());

            $event = new LinkedInTokenEvent($data['access_token'], new \DateTime('+' . $data['expires_at'] . ' seconds'));

            $this->get('event_dispatcher')->dispatch('zorbus_linkedin.access_token', $event);

            return new Response('Retrieved access token. Ready to go.');
        }

        return new Response($response);
    }
}