<?php
/**
 * 请在下面放置任何您需要的应用配置
 *
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author dogstar <chanzonghuang@gmail.com> 2017-07-13
 */

return array(

    /**
     * 应用接口层的统一参数
     */
    'apiCommonRules' => array(
        //'sign' => array('name' => 'sign', 'require' => true),
    ),

    /**
     * 接口服务白名单，格式：接口服务类名.接口服务方法名
     *
     * 示例：
     * - *.*         通配，全部接口服务，慎用！
     * - Site.*      Api_Default接口类的全部方法
     * - *.Index     全部接口类的Index方法
     * - Site.Index  指定某个接口服务，即Api_Default::Index()
     */
    'service_whitelist' => array(
        'Site.Index',
    ),

    'jwt' => array(
        'iss' => 'simple_bookmark.com',
        'key' => 'jwt key'
    ),

    /**
     * redis 配置
     */
    'redis' => array(
        'servers' => array(
            'host' => '127.0.0.1',
            'port' => '6379',
            'prefix' => 'mark_'
        ),
        'DB' => array(
            'email_code' => 1
        )
    ),

    /**
     * 邮件配置
     */
    'PHPMailer' => array(
        'email' => array(
            'host' => 'smtp.host.com',
            'username' => 'user@mail.com',
            'password' => '********',
            'from' => 'user@mail.com',
            'fromName' => 'Simple BookMark',
            'sign' => '<br /><br />请不要回复此邮件，谢谢！<br /><br />'
        )
    )
);
