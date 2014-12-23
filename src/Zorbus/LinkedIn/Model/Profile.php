<?php

namespace Zorbus\LinkedIn\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Expose;

class Profile
{

    /**
     * @Type("string")
     * @Expose()
     */
    protected $firstName;

    /**
     * @Type("string")
     * @Expose()
     */
    protected $lastName;

    /**
     * @Type("string")
     * @Expose()
     */
    protected $headline;

    /**
     * @Type("array")
     * @Expose()
     */
    protected $siteStandardProfileRequest;

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
        return $this->siteStandardProfileRequest['url'];
    }


}