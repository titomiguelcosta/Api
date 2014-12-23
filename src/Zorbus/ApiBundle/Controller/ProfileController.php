<?php

namespace Zorbus\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     * @Method({"GET"})
     * @return array
     */
    public function profileAction()
    {
        $session = $this->get('session');
        $linkedInAccessToken = $session->get('linkedin.access_token');

        if (null === $linkedInAccessToken){
            return new RedirectResponse($this->generateUrl('zorbus_linkedin.authorize', [], true));
        }

        $client = $this->get('zorbus_linkedin.client');
        $client->setAuthorization($linkedInAccessToken);
        $client->setBaseUrl('https://api.linkedin.com/v1');
        $client->setResponseFormat('json');

        $manager = $this->get('zorbus_linkedin.manager');

        return new Response(print_r($manager->getProfile(), true));
    }
}

