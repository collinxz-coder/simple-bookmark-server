<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-09
 * Time: 09:57
 */

namespace App\Api;

use PhalApi\Api;
use PhalApi\Exception\BadRequestException;
use App\Domain\EmailCode as Domain_EmailCode;
use App\Domain\User as Domain_User;

/**
 * 用户接口
 * @package App\Api
 */
class User extends Api
{

    public function getRules()
    {
        return array(
            'register' => array(
                'username' => array('name' => 'username', 'require' => true, 'type' => 'string', 'desc' => '用户名', 'min' => 4),
                'email' => array('name' => 'email', 'require' => true, 'regex' => '/([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})/', 'desc' => '邮箱地址', 'min' => 8),
                'password' => array('name' => 'password', 'require' => true, 'type' => 'string', 'desc' => '密码'),
                'email_code' => array('name' => 'email_code', 'require' => true, 'type' => 'string', 'desc' => '邮箱验证码')
            ),
            'login' => array(
                'username' => array('name' => 'username', 'type' => 'string', 'desc' => '用户名'),
                'email' => array('name' => 'email', 'regex' => '/([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})/', 'desc' => '邮箱地址', 'message' => '邮箱格式错误'),
                'password' => array('name' => 'password', 'type' => 'string', 'require' => true, 'desc' => '密码')
            ),
            'forgetPassword' => array(
                'email' => array('name' => 'email', 'regex' => '/([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})/', 'require' => 'true', 'desc' => '邮箱地址'),
                'email_code' => array('name' => 'email_code', 'type' => 'string', 'require' => true, 'desc' => '邮箱验证码'),
                'new_password' => array('name' => 'new_password', 'type' => 'string', 'require' => true, 'min' => 8, 'desc' => '新密码' ),
            ),
            'sendEmail' => array(
                'email' => array('name' => 'email', 'regex' => '/([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})/', 'require' => 'true', 'desc' => '邮箱地址')
            )
        );
    }

    /**
     * 注册
     * @desc 注册新用户
     *
     * @exception 400 参数错误
     * @exception 10009 邮箱已存在
     * @exception 10010 用户名已存在
     * @exception 10011 注册失败
     * @exception 10012 邮箱验证码错误
     */
    public function register()
    {
        $domain = new Domain_User();
        $domain->register($this->email_code, $this->username, $this->email, $this->password);
    }

    /**
     * 登录
     * @desc 登录接口，登录方式可以是用户名或者邮箱二者选一。
     *
     * @exception 400 参数错误
     */
    public function login()
    {
        if (empty($this->email) && empty($this->username)) {
            throw new BadRequestException("用户名和邮箱地址不能同时为空", 0);
        }

        $domain = new Domain_User();
        $token = $domain->login($this->email, $this->username, $this->password);

        return ['token' => $token];
    }

    /**
     * 忘记密码
     * @desc 找回密码接口
     *
     * @exception 400 参数错误
     */
    public function forgetPassword()
    {
        $domain = new Domain_User();
        $domain->changePassword($this->email, $this->email_code, $this->new_password);
    }

    /**
     * 发送邮件
     * @desc 发送邮件验证码
     *
     * @exception 400 参数错误
     * @exception 10008 邮件发送失败
     */
    public function sendEmail()
    {
        $domain_email_code = new Domain_EmailCode();
        $code = $domain_email_code->addEmailCode($this->email);

        if (! \PhalApi\DI()->mailer->send($this->email, '邮箱验证码', $code)) {
            throw new BadRequestException(ERROR_MSG[SEND_MAIL_ERROR], SEND_MAIL_ERROR);
        }
    }
}