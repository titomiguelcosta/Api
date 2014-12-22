<?php

namespace Zorbus\ApiBundle\Manager;

use Zorbus\ApiBundle\Entity\NewsRepository as NewsEntityRepository;
use Doctrine\Common\Cache\Cache as CacheInterface;
use Zorbus\ApiBundle\Cache\NewsCacheConfiguration;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;
use Zorbus\ApiBundle\Request\News\NewsCreateRequest;

class NewsManager
{

    protected $newsEntityRepository;
    protected $cacheProvider;
    protected $cacheConfiguration;
    protected $uploadManager;

    public function __construct(NewsEntityRepository $newsEntityRepository, CacheInterface $cache, NewsCacheConfiguration $newsCacheConfiguration, UploadableManager $uploadManager)
    {
        $this->newsEntityRepository = $newsEntityRepository;
        $this->cacheProvider = $cache;
        $this->cacheConfiguration = $newsCacheConfiguration;
        $this->uploadManager = $uploadManager;
    }

    public function createNews(NewsCreateRequest $newsCreateRequest)
    {
        $news = $this->newsEntityRepository->createFromNewsCreateRequest($newsCreateRequest, $this->uploadManager);
        
        return $news;
    }

}
