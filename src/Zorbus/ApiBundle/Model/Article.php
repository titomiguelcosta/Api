<?php

namespace Zorbus\ApiBundle\Model;

abstract class Article
{

    protected $title;
    protected $photoName;
    protected $photoPath;
    protected $photoMimeType;
    protected $photoSize;
    protected $content;
    protected $points;
    protected $createdAt;
    protected $updatedAt;
    
    public function getTitle()
    {
        return $this->title;
    }

    public function getPhotoName()
    {
        return $this->photoName;
    }

    public function getPhotoPath()
    {
        return $this->photoPath;
    }

    public function getPhotoMimeType()
    {
        return $this->photoMimeType;
    }

    public function getPhotoSize()
    {
        return $this->photoSize;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setPhotoName($photoName)
    {
        $this->photoName = $photoName;
    }

    public function setPhotoPath($photoPath)
    {
        $this->photoPath = $photoPath;
    }

    public function setPhotoMimeType($photoMimeType)
    {
        $this->photoMimeType = $photoMimeType;
    }

    public function setPhotoSize($photoSize)
    {
        $this->photoSize = $photoSize;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setPoints($points)
    {
        $this->points = $points;
    }

    
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

}
