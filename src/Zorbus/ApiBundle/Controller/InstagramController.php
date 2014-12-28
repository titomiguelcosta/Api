<?php

namespace Zorbus\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class InstagramController extends Controller
{
    /**
     * @Route("/instagram/photos", name="instagram.photos")
     * @Method({"GET"})
     * @return array
     */
    public function photosAction(Request $request)
    {
        $client = $this->get('instagram.client');

        return [
            'auth' => $client->getAccessToken(),
            'user' => $client->getUser(),
            'feed' => $client->getUserFeed(10),
            'photos' => $client->getUserMedia('self', 10)
        ];
    }
}