<?php

namespace Zorbus\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GithubController extends Controller
{
    /**
     * @Route("/github/repositories", name="github.repositories")
     * @Method({"GET"})
     * @return array
     */
    public function repositoriesAction()
    {
        /** @var \Github\Client $client */
        $client = $this->get('github.client');

        return $client->currentUser()->repositories();
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

