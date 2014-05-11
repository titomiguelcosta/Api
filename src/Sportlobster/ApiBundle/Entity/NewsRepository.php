<?php

namespace Sportlobster\ApiBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Sportlobster\ApiBundle\Entity\News as NewsEntity;
use Sportlobster\ApiBundle\Request\News\NewsCreateRequest;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

class NewsRepository extends EntityRepository
{
    public function createFromNewsCreateRequest(NewsCreateRequest $newsCreateRequest, UploadableManager $uploadableManager)
    {
        $userEntity = new NewsEntity();
        $userEntity->setTitle($newsCreateRequest->getTitle());
        $userEntity->setContent($newsCreateRequest->getContent());
        
        $this->_em->persist($userEntity);
        
        $uploadableManager->markEntityToUpload($userEntity, $newsCreateRequest->getPhoto());
        
        $this->_em->flush();

        return $userEntity;
    }
}
