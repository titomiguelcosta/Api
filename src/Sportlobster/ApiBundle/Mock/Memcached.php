<?php

namespace Sportlobster\ApiBundle\Mock;

use Memcached as BaseMemcached;

class Memcached extends BaseMemcached
{

    public function get($key, callable $cache_cb = null, &$cas_token = null)
    {
        return false;
    }

    public function save()
    {
        
    }

    public function delete($key, $time = 0)
    {
        
    }

    public function set($key, $value, $expiration = null)
    {
        
    }

    public function flush($delay = 0)
    {
        
    }

}
