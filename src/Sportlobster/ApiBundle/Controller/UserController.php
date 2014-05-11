<?php

namespace Sportlobster\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\View\View as ViewResponse;
use Tmc\BadRequestBundle\Annotation\BadRequest;
use Sportlobster\ApiBundle\Request\User\UserCreateRequest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UserController extends Controller
{

    /**
     * Details about a particular user
     * 
     * **Response Format**
     * 
     *      {
     *          "user": {
     *              "username": "example"
     *          }
     *      }
     * 
     * @Route("/users/{username}", requirements={"username": "\w+"}, name="users.get")
     * @Method({"GET"})
     * @View(statusCode=200)
     * @View(serializerGroups={"User"})
     * @Cache(expires="+2 days", public=true)
     * @ApiDoc(
     *  section="Users",
     *  resource=true,
     *  requirements={
     *      {"name"="username", "dataType"="string", "requirement"="\w+", "description"="username of the user"},
     *  },
     *  statusCodes={
     *    200="User found",
     *    404="User not found"
     *  },
     *  output="Sportlobster\ApiBundle\Entity\User"
     * )
     */
    public function getAction($username)
    {
        $viewResponse = ViewResponse::create();

        $userManager = $this->get('sportlobster.api.manager.user');
        $userEntity = $userManager->getByUsername($username);

        $viewResponse->setData(array('user' => $userEntity));
        
        return $viewResponse;
    }

    /**
     * @Route("/users", name="users.create")
     * @Method({"POST"})
     * @View(statusCode=201)
     * @BadRequest("Sportlobster\ApiBundle\Type\User\UserCreateType")
     * @ApiDoc(
     *  section="Users",
     *  resource=true,
     *  description="Create a new user",
     *  statusCodes={
     *    201="User created",
     *    400="Bad request"
     *  },
     *  input="Sportlobster\ApiBundle\Type\User\UserCreateType",
     *  output="Sportlobster\ApiBundle\Entity\User"
     * )
     */
    public function createAction(UserCreateRequest $userCreateRequest)
    {
        $viewResponse = ViewResponse::create();

        $userEntityRepository = $this->get('sportlobster.api.entity.repository.user');
        $userEntity = $userEntityRepository->createFromUserCreateRequest($userCreateRequest);

        $viewResponse->setData(array('user' => $userEntity));
        $viewResponse->setHeader('Location', $this->generateUrl('users.get', array('username' => $userEntity->getUsername()), true));

        return $viewResponse;
    }
    
    /**
     * @Route("/users/{username}", name="users.edit")
     * @Method({"PUT"})
     * @View(statusCode=200)
     * @BadRequest("Sportlobster\ApiBundle\Type\User\UserCreateType")
     * @ApiDoc(
     *  section="Users",
     *  resource=true,
     *  description="Edit a user",
     *  statusCodes={
     *    200="User edited",
     *    400="Bad request"
     *  },
     *  input="Sportlobster\ApiBundle\Type\User\UserCreateType",
     *  output="Sportlobster\ApiBundle\Entity\User"
     * )
     */
    public function editAction(UserCreateRequest $userCreateRequest)
    {
        
    }

}
