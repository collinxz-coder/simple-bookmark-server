<?php
/**
 * PhalApi_App\Api\BookMark_Test
 *
 * 针对 ./src/app/Api/BookMark.php App\Api\BookMark 类的PHPUnit单元测试
 *
 * @author: dogstar 20190905
 */

namespace tests\App\Api;
use App\Api\BookMark;

class PhpUnderControl_AppApiBookMark_Test extends \PHPUnit\Framework\TestCase
{
    public $appApiBookMark;

    protected function setUp()
    {
        parent::setUp();

        $this->appApiBookMark = new \App\Api\BookMark();
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
        $rs = $this->appApiBookMark->getRules();
    }

    /**
     * @group testGetAllBookMark
     */ 
    public function testGetAllBookMark()
    {
        $rs = $this->appApiBookMark->getAllBookMark();

        $this->assertTrue(is_array($rs));

    }

    /**
     * @group testAddBookMark
     */ 
    public function testAddBookMark()
    {
        $rs = $this->appApiBookMark->addBookMark();
    }

    /**
     * @group testDeleteBookMark
     */ 
    public function testDeleteBookMark()
    {
        $rs = $this->appApiBookMark->deleteBookMark();
    }

    /**
     * @group testModifyBookMark
     */ 
    public function testModifyBookMark()
    {
        $rs = $this->appApiBookMark->modifyBookMark();
    }

    /**
     * @group testIncreaseReadCount
     */ 
    public function testIncreaseReadCount()
    {
        $rs = $this->appApiBookMark->increaseReadCount();
    }

    /**
     * @group testReadCountTop
     */ 
    public function testReadCountTop()
    {
        $rs = $this->appApiBookMark->readCountTop();

        $this->assertTrue(is_array($rs));

    }

    /**
     * @group testGetBookMarkFromClass
     */ 
    public function testGetBookMarkFromClass()
    {
        $rs = $this->appApiBookMark->getBookMarkFromClass();

        $this->assertTrue(is_array($rs));

    }

}
