<?php

namespace Sportlobster\ApiBundle\Cache;

class NewsCacheConfiguration
{

    public static function getNewsKey($id)
    {
        return 'sportlobster.news.id.' . $id;
    }

    public function getNewsLifetime()
    {
        return 3600;
    }

}
