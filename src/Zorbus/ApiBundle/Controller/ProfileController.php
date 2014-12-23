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
    public function repositoriesAction()
    {
        $client = $this->get('zorbus_linkedin.client');
        $manager = $this->get('zorbus_linkedin.manager');
        $session = $this->get('session');
        $linkedInAccessToken = $session->get('linkedin.access_token');

        if (null === $linkedInAccessToken){
            return new RedirectResponse($this->generateUrl('zorbus_linkedin.authenticate', [], true));
        }

        $client->setAuthorization($linkedInAccessToken);
        $client->setBaseUrl('https://api.linkedin.com/v1');

        return new Response($manager->getProfile());
    }

    /**
     * @Route("/github/user", name="github.user")
     * @Method({"GET"})
     * @return array
     */
    public function userAction()
    {
        /** @var \Github\Client $client */
        $client = $this->get('github.client');

        return $client->currentUser()->show();
    }
}

