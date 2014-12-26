<?php

namespace Zorbus\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TwitterController extends Controller
{
    /**
     * @Route("/twitter/tweets", name="twitter.tweets")
     * @Method({"GET"})
     * @return array
     */
    public function tweetsAction()
    {
        /** @var \ZendService\Twitter\Twitter $client */
        $client = $this->get('twitter.client');

        $response = $client->accountVerifyCredentials();

        if (!$response->isSuccess()) {
            die('Something is wrong with my credentials!');
        }

        $response = $client->search->statuses->userTimeline([
            'count' => 10,
        ]);

        $tweets = [];

        foreach ($response->toValue() as $tweet){
            $tweets[] = [
                'text' => $tweet->text,
                'date' => date('c', strtotime($tweet->created_at))
            ];
        }

        return $tweets;
    }

}

