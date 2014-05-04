<?php

namespace Sportlobster\ApiBundle\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\ExclusionPolicy("all")
 */
class User implements SerializableInterface
{

    /**
     * @JMS\Expose()
     * @JMS\Type("string")
     * @JMS\Groups({"User", "Admin"})
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

    /** 
     * @JMS\Expose()
     * @JMS\Accessor(getter="getFullName")
     * @JMS\Type("string")
     * @JMS\SerializedName("full_name")
     * @JMS\Groups({"Admin"})
     */
    protected $firstName;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFullName()
    {
        return $this->getUsername() . ': ' . $this->getFirstName();
    }

}
