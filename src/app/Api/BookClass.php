<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-08-30
 * Time: 11:17
 */
namespace App\Api;

use PhalApi\Api;
use App\Domain\BookClass as Domain_BookClass;
use PhalApi\Exception\BadRequestException;

/**
 * 书签分类
 * @package App\Api
 */
class BookClass extends Api
{
    public function getRules()
    {
        return array(
            'addClass' => array(
                'parent_id' => array('name' => 'parent_id', 'type' => 'int', 'require' => true, 'desc' => '父级分类'),
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '分类名称'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            ),
            'deleteClass' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '分类id'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            ),
            'modifyClass' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '分类id'),
                'parent_id' => array('name' => 'parent_id', 'type' => 'int', 'require' => true, 'desc' => '父级分类'),
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '分类名称'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            ),
            'classBookMarkCount' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '分类id'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            )
        );
    }

    /**
     * 添加分类
     * @desc 添加书签分类
     *
     * @exception 400 参数不匹配
     * @exception 10001 添加数据失败
     */
    public function addClass()
    {
        $domainBookClass = new Domain_BookClass();
        $domainBookClass->addClass($this->name, $this->parent_id);
    }

    /**
     * 删除分类
     * @desc 删除指定分类
     *
     * @exception 400 参数不匹配
     * @exception 1002 子分类不为空，删除失败
     * @exception 1003 分类下还有书签，删除失败
     * @exception 1004 删除失败
     */
    public function deleteClass()
    {
        $domainBookClass = new Domain_BookClass();
        $domainBookClass->deleteClass($this->id);
    }

    /**
     * 修改分类
     * @desc 修改指定分类
     *
     * @exception 400 参数不匹配
     * @exception 1005 修改失败
     */
    public function modifyClass()
    {
        $domainBookClass = new Domain_BookClass();
        $domainBookClass->updateClass($this->id, $this->parent_id, $this->name);
    }


    /**
     * 获取指定分类下的书签数量
     * @获取指定分类下的书签数量
     *
     * @return int count 书签数量
     * @exception 400 参数不匹配
     */
    public function classBookMarkCount()
    {
        $domainBookClass = new Domain_BookClass();
        $count = $domainBookClass->getCount($this->id);
        return array('count' => $count);
    }
}