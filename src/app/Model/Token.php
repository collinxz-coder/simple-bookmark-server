<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-11
 * Time: 10:31
 */

namespace App\Model;

class Token
{
    public function addToken($token, $user_id)
    {
        // 过期时间为1月
        \PhalApi\DI()->cache->set("TOKEN_" . $token, $user_id, 60 * 60  * 24 * 30);
    }


    public function checkToken($token)
    {
        $res = \PhalApi\DI()->cache->get("TOKEN_" . $token);
        return ! empty($res);
    }

    public function getUserId($token)
    {
        return \PhalApi\DI()->cache->get("TOKEN_" . $token);
    }
}