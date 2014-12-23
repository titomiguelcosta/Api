<?php

namespace Zorbus\LinkedIn\Model;

use JMS\Serializer\Annotation\Type;

class Profile
{

    /**
     * @Type("string")
     */
    protected $firstName;

    /**
     * @Type("string")
     */
    protected $lastName;

    /**
     * @Type("string")
     */
    protected $headline;

    /**
     * @Type("string")
     */
    protected $url;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }


}