<?php

namespace Zorbus\LinkedInBundle\Controller;

use GuzzleHttp\Message\Response as GuzzleResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LinkedInController extends Controller
{
    /**
     * @Route("/authorize", name="zorbus.linkedin.authorize")
     * @Method({"GET"})
     */
    public function authorizeAction(Request $request)
    {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus.linkedin.manager');

        $key = $this->container->getParameter('zorbus.linkedin.key');
        $scope = $this->container->getParameter('zorbus.linkedin.scope');
        $url = $this->generateUrl('zorbus.linkedin.authenticate', [], true);

        $manager->authorize($key, $scope, $url);
    }

    /**
     * @Route("/authenticate", name="zorbus.linkedin.authenticate")
     * @Method({"GET", "POST"})
     */
    public function authenticateAction(Request $request)
    {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus.linkedin.manager');

        $code = $request->query->get('code');
        $state = $request->query->get('state');
        $secret = $this->container->getParameter('zorbus.linkedin.secret');
        $key = $this->container->getParameter('zorbus.linkedin.key');
        $redirectUrl =  $this->generateUrl('zorbus.linkedin.authenticate', [], true);

        $response = $manager->authenticate($code, $state, $secret, $key, $redirectUrl);

        if ($response instanceof GuzzleResponse) {
            return new JsonResponse(json_encode($response->getBody()->getContents()));
        }

        return new Response($response);
    }
}