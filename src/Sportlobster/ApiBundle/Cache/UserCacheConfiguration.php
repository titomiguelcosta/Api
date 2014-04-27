<?php

namespace Sportlobster\ApiBundle\Cache;

class UserCacheConfiguration
{

    public static function getUserKey($id)
    {
        return 'sportlobster.user.id.' . $id;
    }

    public function getUserLifetime()
    {
        return 3600;
    }

}
