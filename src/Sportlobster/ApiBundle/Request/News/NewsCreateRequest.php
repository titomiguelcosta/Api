<?php

namespace Sportlobster\ApiBundle\Request\News;

use Symfony\Component\Validator\Constraints as Assert;

class NewsCreateRequest
{

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "5",
     *      max = "255",
     *      minMessage = "The title must be at least {{ limit }} characters length",
     *      maxMessage = "The title cannot be longer than {{ limit }} characters length"
     * )
     */
    protected $title;

    /**
     * @Assert\NotBlank()
     */
    protected $content;

    /**
     * @Assert\NotBlank()
     * @Assert\Image()
     */
    protected $photo;

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

}
