<?php

namespace Sportlobster\ApiBundle\Entity;

use Sportlobster\ApiBundle\Model\News as NewsModel;

class News extends NewsModel
{
    private $id;
    private $slug;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

}
