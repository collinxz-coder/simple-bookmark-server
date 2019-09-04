<?php
/**
 * PhalApi_App\Api\BookClass_Test
 *
 * 针对 ./src/app/Api/BookClass.php App\Api\BookClass 类的PHPUnit单元测试
 *
 * @author: dogstar 20190905
 */

namespace tests\App\Api;

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

    }

    /**
     * @group testModifyClass
     */ 
    public function testModifyClass()
    {

    }

    /**
     * @group testClassBookMarkCount
     */ 
    public function testClassBookMarkCount()
    {

    }

}
