<?php
/**
 * PhalApi_App\Api\BookMark_Test
 *
 * 针对 ./src/app/Api/BookMark.php App\Api\BookMark 类的PHPUnit单元测试
 *
 * @author: dogstar 20190905
 */

namespace tests\App\Api;

use PhalApi\Helper\TestRunner;

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
     * @group testGetAllBookMark
     */ 
    public function testGetAllBookMark()
    {
        $url = 's=BookMark.GetAllBookMark';
        $params = array();
        $rs = TestRunner::go($url, $params);

        $data = $rs['data'];

        if (!empty($data)) {
            $bookmark = $data[0];
            $this->assertArrayHasKey('mark_name', $bookmark);
            $this->assertArrayHasKey('url', $bookmark);
            $this->assertArrayHasKey('class_id', $bookmark);
        }
    }

    /**
     * @group testAddBookMark
     */ 
    public function testAddBookMark()
    {
        try {
            $url = 's=BookMark.AddBookMark';
            $params = array('class_id' => 1, 'name' => 'test_bookmark', 'url' => 'https://www.baidu.com/');

            TestRunner::go($url, $params);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }

        $this->assertTrue(true);
    }

    /**
     * @group testDeleteBookMark
     */ 
    public function testDeleteBookMark()
    {
        try {
            $url = 's=BookMark.DeleteBookMark';
            $params = array('id' => 1);

            TestRunner::go($url, $params);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertTrue(true);
    }

    /**
     * @group testModifyBookMark
     */ 
    public function testModifyBookMark()
    {
        try {
            $url = 's=BookMark.ModifyBookMark';
            $params = array('id' => 1, 'name' => 'collin test', 'url' => 'http://www.baidu.com');

            TestRunner::go($url, $params);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertTrue(true);
    }

    /**
     * @group testIncreaseReadCount
     */ 
    public function testIncreaseReadCount()
    {
        try {
            $url = 's=BookMark.IncreaseReadCount';
            $params = array('id' => 1);

            TestRunner::go($url, $params);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertTrue(true);
    }

    /**
     * @group testReadCountTop
     */ 
    public function testReadCountTop()
    {
        $url = 's=BookMark.ReadCountTop';
        $params = array('count' => 10, 'class_id' => 1);

        $res = TestRunner::go($url, $params);

        if (!empty($res)) {
            $mark = $res[0];
            $this->assertArrayHasKey('mark_name', $mark);
            $this->assertArrayHasKey('url', $mark);
            $this->assertArrayHasKey('class_id', $mark);
        }
    }

    /**
     * @group testGetBookMarkFromClass
     */ 
    public function testGetBookMarkFromClass()
    {
        $url = 's=BookMark.GetBookMarkFromClass';
        $params = array('class_id' => 1);

        $res = TestRunner::go($url, $params);

        if (!empty($res)) {
            $mark = $res[0];
            $this->assertArrayHasKey('mark_name', $mark);
            $this->assertArrayHasKey('url', $mark);
            $this->assertArrayHasKey('class_id', $mark);
        }
    }

}
