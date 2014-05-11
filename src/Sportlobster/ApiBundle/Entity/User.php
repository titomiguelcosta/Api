<?php

namespace Sportlobster\ApiBundle\Entity;

use Sportlobster\ApiBundle\Model\User as UserModel;

class User extends UserModel
{

    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
}
