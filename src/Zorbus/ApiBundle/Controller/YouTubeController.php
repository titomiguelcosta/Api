<?php

namespace Zorbus\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class YouTubeController extends Controller
{
    /**
     * @Route("/youtube/playlists", name="youtube.playlists")
     * @Method({"GET"})
     * @return array
     */
    public function playlistsAction()
    {
        /** @var \Google_Service_YouTube $client */
        $client = $this->get('youtube.client');

        /** @var \Google_Service_YouTube_PlaylistListResponse $response */
        $response = $client->playlists->listPlaylists('contentDetails', [
            'mine' => true,
            'maxResults' => 10
        ]);

        return $response->getItems();
    }
}

