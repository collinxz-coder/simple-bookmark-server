<?php
/**
 * PhalApi_App\Api\BookClass_Test
 *
 * 针对 ./src/app/Api/BookClass.php App\Api\BookClass 类的PHPUnit单元测试
 *
 * @author: dogstar 20190905
 */

namespace tests\App\Api;
use App\Api\BookClass;

class PhpUnderControl_AppApiBookClass_Test extends \PHPUnit\Framework\TestCase
{
    public $appApiBookClass;

    protected function setUp()
    {
        parent::setUp();

        $this->appApiBookClass = new \App\Api\BookClass();
    }

    protected function tearDown()
    {
        // 输出本次单元测试所执行的SQL语句
        // var_dump(\PhalApi\DI()->tracer->getSqls());

        // 输出本次单元测试所涉及的追踪埋点
        // var_dump(\PhalApi\DI()->tracer->getStack());
    }


    /**
     * @group testGetRules
     */
    public function testGetRules()
    {
        $rs = $this->appApiBookClass->getRules();
    }

    /**
     * @group testAddClass
     */ 
    public function testAddClass()
    {
        $rs = $this->appApiBookClass->addClass();
    }

    /**
     * @group testDeleteClass
     */ 
    public function testDeleteClass()
    {
        $rs = $this->appApiBookClass->deleteClass();
    }

    /**
     * @group testModifyClass
     */ 
    public function testModifyClass()
    {
        $rs = $this->appApiBookClass->modifyClass();
    }

    /**
     * @group testClassBookMarkCount
     */ 
    public function testClassBookMarkCount()
    {
        $rs = $this->appApiBookClass->classBookMarkCount();

        $this->assertTrue(is_int($rs));

    }

}
