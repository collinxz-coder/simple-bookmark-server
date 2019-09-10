<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-10
 * Time: 15:25
 */
namespace App\Model;

use PhalApi\Model\NotORMModel;

class User extends NotORMModel
{
    const KEY_ID = 'id';
    const KEY_USERNAME = 'username';
    const KEY_EMAIL = 'email';
    const KEY_PASSWORD = 'password';
    const KEY_CREATE_AT = 'create_at';
    const KEY_LAST_LOGIN_AT = 'last_login_at';

    /**
     * 添加新的用户.
     *
     * @param string $username 用户名
     * @param string $email 邮箱地址
     * @param string $password 密码
     * @return string
     */
    public function addUser($username, $email, $password)
    {
        $orm = $this->getORM();
        $data = [
            self::KEY_USERNAME => $username,
            self::KEY_EMAIL => $email,
            self::KEY_PASSWORD => $password,
            self::KEY_CREATE_AT => time(),
            self::KEY_LAST_LOGIN_AT => 0
        ];

        $orm->insert($data);

        return $orm->insert_id();
    }

    /**
     * 邮箱是否存在
     *
     * @param $email
     * @return bool
     */
    public function emailExists($email)
    {
        $orm = $this->getORM();
        $count = $orm->where(self::KEY_EMAIL, $email)->count();
        return $count > 0;
    }

    /***
     * 用户名是否存在.
     *
     * @param $username
     * @return bool
     */
    public function usernameExists($username)
    {
        $orm = $this->getORM();
        $count = $orm->where(self::KEY_USERNAME, $username)->count();
        return $count > 0;
    }

    /**
     * 用户名登录
     *
     * @param string $username 用户名
     * @param string $password 密码
     * @return mixed
     */
    public function loginByUserName($username, $password)
    {
        $orm = $this->getORM();
        return $orm->where(self::KEY_USERNAME, $username)->where(self::KEY_PASSWORD, $password)->fetchOne();
    }

    /**
     * 邮箱登录.
     *
     * @param string $email 邮箱地址
     * @param string $password 密码
     * @return mixed
     */
    public function loginByEmail($email, $password)
    {
        $orm = $this->getORM();
        return $orm->where(SELF::KEY_EMAIL, $email)->where(self::KEY_PASSWORD, $password)->fetchOne();
    }

    /**
     * 修改用户登录时间
     *
     * @param int $user_id 用户id
     * @return int
     */
    public function modifyLoginTime($user_id)
    {
        $orm = $this->getORM();
        return $orm->where(self::KEY_ID, $user_id)->update([self::KEY_LAST_LOGIN_AT => time()]);
    }

    /**
     * 修改用户密码
     *
     * @param string $email 邮箱
     * @param string $new_password 新密码
     * @return int
     */
    public function modifyPassword($email, $new_password)
    {
        $orm = $this->getORM();
        return $orm->where(self::KEY_EMAIL, $email)->update([self::KEY_PASSWORD => $new_password]);
    }
}