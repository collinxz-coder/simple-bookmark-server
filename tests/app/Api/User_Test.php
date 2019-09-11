<?php
/**
 * PhalApi_App\Api\User_Test
 *
 * 针对 ./src/app/Api/User.php App\Api\User 类的PHPUnit单元测试
 *
 * @author: dogstar 20190909
 */

namespace tests\App\Api;
use PhalApi\Helper\TestRunner;

require_once dirname(__FILE__) . '/../../bootstrap.php';

class PhpUnderControl_AppApiUser_Test extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        // 输出本次单元测试所执行的SQL语句
        // var_dump(\PhalApi\DI()->tracer->getSqls());

        // 输出本次单元测试所涉及的追踪埋点
        // var_dump(\PhalApi\DI()->tracer->getStack());
    }

    /**
     * @group testRegister
     */ 
    public function testRegister()
    {
//        try {
//            $url = 's=User.Register';
//            $params = array(
//                'username' => 'collin',
//                'email' => 'pchangl@163.com',
//                'password' => '123456789',
//                'email_code' => '80253',
//            );
//
//            TestRunner::go($url, $params);
//        } catch (\Exception $e) {
//            $this->fail($e->getMessage());
//        }
//        $this->assertTrue(true);
    }

    /**
     * @group testLogin
     */ 
    public function testLogin()
    {
        try {
            $url = 's=User.Login';
            $params = array(
                'username' => 'collin',
                'password' => '123456789'
            );

            $res = TestRunner::go($url, $params);

            var_dump($res);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        $this->assertTrue(true);
    }

    /**
     * @group testForgetPassword
     */ 
    public function testForgetPassword()
    {
//        try {
//            $url = 's=User.ForgetPassword';
//            $params = array(
//                'email' => 'pchangl@163.com',
//                'email_code' => '35277',
//                'new_password' => '123456789'
//            );
//
//            TestRunner::go($url, $params);
//        } catch (\Exception $e) {
//            $this->fail($e->getMessage());
//        }
//
//        $this->assertTrue(true);
    }

    /**
     * @group testSendEmail
     */ 
    public function testSendEmail()
    {
//        try {
//            $url = 's=User.SendEmail';
//            $params = array('email' => 'pchangl@163.com');
//
//            TestRunner::go($url, $params);
//        } catch (\Exception $e) {
//            $this->fail($e->getMessage());
//        }
//
//        $this->assertTrue(true);
    }

}
