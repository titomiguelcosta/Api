<?php

namespace Zorbus\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class LinkedInController extends Controller
{
    /**
     * @Route("/linkedin/authorize", name="linkedin.authorize")
     * @Method({"GET"})
     */
    public function authorizeAction(Request $request)
    {
        $state = 'RfDeSAddddddE2' . rand(1, 5000);
        $request->getSession()->set('linkedin_state', $state);

        $url = sprintf('https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=%s&scope=%s&state=%s&redirect_uri=%s',
            $this->container->getParameter('linkedin_key'),
            urlencode('r_fullprofile r_network r_emailaddress r_contactinfo'),
            $state,
            urlencode($this->generateUrl('linkedin.authenticate', [], true))
        );

        return new RedirectResponse($url);
    }

    /**
     * @Route("/linkedin/authenticate", name="linkedin.authenticate")
     * @Method({"GET", "POST"})
     */
    public function authenticateAction(Request $request)
    {
        $code = $request->query->get('code');
        $state = $request->query->get('state');

        if ($state !== $request->getSession()->get('linkedin_state')) {
            $message = sprintf('State %s does not match the saved state %s.', $state, $request->getSession()->get('state'));
            $this->get('logger')->error($message);
            throw new UnauthorizedHttpException($message);
        } else {
            $request->getSession()->remove('linkedin_state');
        }

        $url = sprintf('https://www.linkedin.com/uas/oauth2/accessToken?grant_type=authorization_code&code=%s&redirect_uri=%s&client_id=%s&client_secret=%s',
            $code,
            urlencode($this->generateUrl('linkedin.authenticate', [], true)),
            $this->container->getParameter('linkedin_key'),
            $this->container->getParameter('linkedin_secret')
        );

        $client = new Client();
        try {
            $response = $client->post($url);
            $body = $response->getBody()->getContents();

            return new JsonResponse(json_decode($body));
        } catch (ClientException $e) {
            return new JsonResponse([$e->getResponse()->getBody()->getContents(), $url], 400);
        }
    }
}