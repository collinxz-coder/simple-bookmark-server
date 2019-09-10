<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-10
 * Time: 15:29
 */

namespace App\Domain;

use \App\Model\User as Model_User;
use \App\Model\EmailCode as Model_EmailCode;

use PhalApi\Exception\BadRequestException;

class User
{
    /**
     * 注册用户.
     *
     * @param string $email_code 邮箱验证码
     * @param string $username 用户名
     * @param string $email 邮箱地址
     * @param string $password 密码
     * @throws BadRequestException
     */
    public function register($email_code, $username, $email, $password)
    {
        $model = new Model_User();
        $model_EmailCode = new Model_EmailCode();

        if (! $model_EmailCode->checkOnce($email, $email_code)) {
            throw new BadRequestException(ERROR_MSG[EMAIL_CODE_ERROR], EMAIL_CODE_ERROR);
        }
        if ($model->emailExists($email)) {
            throw new BadRequestException(ERROR_MSG[EMAIL_EXISTS], EMAIL_EXISTS);
        }
        if ($model->usernameExists($username)) {
            throw new BadRequestException(ERROR_MSG[USERNAME_EXISTS], USERNAME_EXISTS);
        }

        $password = md5($password);
        $insert_id = $model->addUser($username, $email, $password);

        if ($insert_id <= 0) {
            throw new BadRequestException(ERROR_MSG[REGISTER_ERROR], REGISTER_ERROR);
        }
    }

    /**
     * 使用邮箱或者用户名登录.
     *
     * @param string $email 邮箱地址
     * @param string $username 用户名
     * @param string $password 密码
     * @throws BadRequestException
     */
    public function login($email, $username, $password)
    {
        $model = new Model_User();
        $password = md5($password);

        $userInfo = null;
        if (!empty($email)) {
            $userInfo = $model->loginByEmail($email, $password);
        } elseif (!empty($username)) {
            $userInfo = $model->loginByUserName($username, $password);
        }

        if (empty($userInfo)) {
            throw new BadRequestException(ERROR_MSG[VERIFY_ERROR], VERIFY_ERROR);
        } else {
            $user_id = $userInfo[Model_User::KEY_ID];
            $model->modifyLoginTime($user_id);
        }

        // TODO: 缓存登录信息
    }

    /**
     * 修改用户密码.
     *
     * @param string $email_code 邮箱验证码
     * @param string $new_password 新密码
     * @throws BadRequestException
     */
    public function changePassword($email, $email_code, $new_password)
    {
        $model = new Model_User();

        $new_password = md5($new_password);
        $model_EmailCode = new Model_EmailCode();
        if (! $model_EmailCode->checkOnce($email, $email_code)) {
            throw new BadRequestException(ERROR_MSG[EMAIL_CODE_ERROR], EMAIL_CODE_ERROR);
        }

        if (! $model->modifyPassword($email, $new_password)) {
            throw new BadRequestException(ERROR_MSG[MODIFY_PASSWORD_ERROR], MODIFY_PASSWORD_ERROR);
        }
    }
}