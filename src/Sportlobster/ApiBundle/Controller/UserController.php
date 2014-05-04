<?php

namespace Sportlobster\ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route("/users/{id}", requirements={"id": "\d+"}, name="users.get")
     * @Method({"GET"})
     * @View(statusCode=200)
     * @View(serializerGroups={"User"})
     * @Cache(expires="+2 days", public=true)
     * @ApiDoc(
     *  section="Users",
     *  resource=true,
     *  requirements={
     *      {"name"="id", "dataType"="integer", "requirement"="\d+", "description"="id of the user"},
     *  },
     *  statusCodes={
     *    200="User found",
     *    404="User not found"
     *  },
     *  output="Sportlobster\ApiBundle\Entity\User"
     * )
     */
    public function getAction($id)
    {
        $viewResponse = ViewResponse::create();
        
        $userManager = $this->get('sportlobster.api.manager.user');
        $userEntity = $userManager->getById($id);

        $viewResponse->setData(array('user' => $userEntity));
        $viewResponse->setHeader('Location', $this->generateUrl('users.get', array('id' => $id), true));
        
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
     *  description="Creation of a new user",
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
        $userEntityRepository = $this->get('sportlobster.api.entity.repository.user');
        $userEntity = $userEntityRepository->createFromUserCreateRequest($userCreateRequest);

        return $userEntity;
    }

}
