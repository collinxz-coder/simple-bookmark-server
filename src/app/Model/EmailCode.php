<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-09
 * Time: 11:21
 */
namespace App\Model;

class EmailCode
{
    /**
     * 存放验证码.
     *
     * @param $email
     * @param $code
     */
    public function insert($email, $code)
    {
        \PhalApi\DI()->cache->set($email, $code);
    }

    /**
     * 获取验证码.
     *
     * @param $email
     * @return mixed
     */
    public function getCode($email)
    {
        return \PhalApi\DI()->cache->get($email);
    }

    /**
     * 判断邮箱验证码是否存在，如果存在，返回 true 并删除这个 key.
     *
     * @param string $email 邮箱地址
     * @param string $code 要比较的code
     * @return bool
     */
    public function checkOnce($email, $code)
    {
        $tmp = \PhalApi\DI()->cache->get($email);
        if ($code == $tmp) {
            \PhalApi\DI()->cache->delete($email);
            return true;
        }

        return false;
    }
}