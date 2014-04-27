<?php

namespace Sportlobster\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations\View;
use Tmc\BadRequestBundle\Annotation\BadRequest;
use Sportlobster\ApiBundle\Request\User\UserCreateRequest;

class UserController extends Controller
{

    /**
     * @Route("/users/{id}", requirements={"id": "\d+"}, name="user.get")
     * @Method({"GET"})
     * @View(statusCode=200)
     */
    public function getAction($id)
    {
        $userRepository = $this->get('sportlobster.api.model.repository.user');
        $userModel = $userRepository->getById($id);

        return $userModel->toArray();
    }

    /**
     * @Route("/users/{id}", requirements={"id": "\d+"}, name="user.create")
     * @Method({"POST"})
     * @View(statusCode=201)
     * @BadRequest("Sportlobster\ApiBundle\Type\User\UserCreateType")
     */
    public function createAction(UserCreateRequest $userCreateRequest)
    {
        $userRepository = $this->get('sportlobster.api.model.repository.user');
        $userModel = $userRepository->createFromUserCreateRequest($userCreateRequest);

        return $this->getAction($userModel->getId());
    }

}
