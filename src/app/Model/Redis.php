<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-10
 * Time: 16:47
 */

namespace App\Model;

use PhalApi\Cache\RedisCache;

class Redis extends RedisCache
{
    public function delete($key)
    {
        return $this->redis->del($this->formatKey($key));
    }
}