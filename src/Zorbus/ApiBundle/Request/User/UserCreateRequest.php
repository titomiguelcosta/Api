<?php

namespace Zorbus\ApiBundle\Request\User;

use Symfony\Component\Validator\Constraints as Assert;

class UserCreateRequest
{

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "5",
     *      max = "50",
     *      minMessage = "Your username must be at least {{ limit }} characters length",
     *      maxMessage = "Your username cannot be longer than {{ limit }} characters length"
     * )
     * @Assert\Regex("/^\w+$/")
     */
    protected $username;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

}
