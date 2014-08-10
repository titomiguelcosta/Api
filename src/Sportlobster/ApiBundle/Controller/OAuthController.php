<?php

namespace Sportlobster\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class OAuthController extends Controller
{

    /**
     * @Route("/oauth/client", name="oauth.client")
     * @Method({"GET"})
     */
    public function clientAction()
    {
        // creating a client
        $clientManager = $this->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setRedirectUris(array('http://www.titomiguelcosta.com/'));
        $client->setAllowedGrantTypes(array('token', 'authorization_code'));
        $clientManager->updateClient($client);

        // redirecting to the authorized page
        return $this->redirect($this->generateUrl('fos_oauth_server_authorize', array(
                            'client_id' => $client->getPublicId(),
                            'redirect_uri' => 'http://www.titomiguelcosta.com/',
                            'response_type' => 'code'
        )));
    }
}
