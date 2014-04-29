<?php

namespace Sportlobster\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sportlobster\ApiBundle\Model\User as UserModel;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sportlobster\ApiBundle\Entity\UserRepository")
 */
class User extends UserModel
{

    private $id;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

}
