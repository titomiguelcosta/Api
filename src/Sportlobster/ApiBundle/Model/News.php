<?php

namespace Sportlobster\ApiBundle\Model;

class News extends Article
{

    protected $source;

    public function getSource()
    {
        return $this->source;
    }

    public function setSource($source)
    {
        $this->source = $source;
    }

}
