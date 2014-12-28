<?php

namespace Zorbus\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class YouTubeController extends Controller
{
    /**
     * @Route("/youtube/music", name="youtube.playlists")
     * @Method({"GET"})
     * @return array
     */
    public function playlistsAction(Request $request)
    {
        $page = $request->query->get('page', null);

        /** @var \Google_Service_YouTube $client */
        $client = $this->get('youtube.client');

        $response = $client->playlistItems->listPlaylistItems('snippet', [
            'playlistId' => 'PL3E4772C48425800C',
            'maxResults' => 5,
            'pageToken' => $page
        ]);

        return [
            'nextPageToken' => $response->getNextPageToken(),
            'prevPageToken' => $response->getPrevPageToken(),
            'items' => $response->getItems(),
        ];
    }
}