<?php

namespace Zorbus\LinkedIn\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\SerializedName;

/**
 * @ExclusionPolicy("all")
 */
class Profile
{
    /**
     * @Type("string")
     * @Expose()
     * @SerializedName("firstName")
     */
    protected $firstName;

    /**
     * @Type("string")
     * @Expose()
     * @SerializedName("lastName")
     */
    protected $lastName;

    /**
     * @Type("string")
     * @Expose()
     * @SerializedName("headline")
     */
    protected $headline;

    /**
     * @Type("array")
     * @Expose()
     * @SerializedName("siteStandardProfileRequest")
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