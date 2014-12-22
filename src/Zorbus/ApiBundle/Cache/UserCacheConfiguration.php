<?php

namespace Zorbus\ApiBundle\Cache;

class UserCacheConfiguration
{

    public static function getUserKey($id)
    {
        return 'Zorbus.user.id.' . $id;
    }

    public function getUserLifetime()
    {
        return 3600;
    }

}
