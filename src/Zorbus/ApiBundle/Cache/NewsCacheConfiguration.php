<?php

namespace Zorbus\ApiBundle\Cache;

class NewsCacheConfiguration
{

    public static function getNewsKey($id)
    {
        return 'Zorbus.news.id.' . $id;
    }

    public function getNewsLifetime()
    {
        return 3600;
    }

}
