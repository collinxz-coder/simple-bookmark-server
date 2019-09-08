<?php
/**
 * PhalApi_App\Api\BookClass_Test
 *
 * 针对 ./src/app/Api/BookClass.php App\Api\BookClass 类的PHPUnit单元测试
 *
 * @author: dogstar 20190905
 */

namespace tests\App\Api;

use PhalApi\Helper\TestRunner;

require_once dirname(__FILE__) . '/../../bootstrap.php';

class PhpUnderControl_AppApiBookClass_Test extends \PHPUnit\Framework\TestCase
{
    public $appApiBookClass;

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


    public function testAddClass()
    {
        try {
            $url = 's=BookClass.AddClass';
            $params = array('parent_id' => 0, 'name' => '测试分类');

            $rs = \PhalApi\Helper\TestRunner::go($url, $params);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        $this->assertTrue(true);
    }

    /**
     * @group testDeleteClass
     */ 
    public function testDeleteClass()
    {
        try {
            $url = 's=BookClass.DeleteClass';
            $params = array('id' => 1);

            $rs = \PhalApi\Helper\TestRunner::go($url, $params);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        $this->assertTrue(true);
    }

    /**
     * @group testModifyClass
     */ 
    public function testModifyClass()
    {
        try {
            $url = 's=BookClass.ModifyClass';
            $params = array('id' => 1, 'parent_id' => 0, 'name' => 'collin');
            $res = TestRunner::go($url, $params);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        $this->assertTrue(true);
    }

    /**
     * @group testClassBookMarkCount
     */ 
    public function testClassBookMarkCount()
    {
        $url = 's=BookClass.classBookMarkCount';
        $params = array('id' => 1);

        $res = TestRunner::go($url, $params);

        $this->assertArrayHasKey('count', $res);
    }

}
