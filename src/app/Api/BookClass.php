<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-08-30
 * Time: 11:17
 */
namespace App\Api;

use PhalApi\Api;

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
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '分类名称')
            ),
            'deleteClass' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '分类id')
            ),
            'modifyClass' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '分类id'),
                'parent_id' => array('name' => 'parent_id', 'type' => 'int', 'require' => true, 'desc' => '父级分类'),
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '分类名称')
            ),
            'classBookMarkCount' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '分类id'),
            )
        );
    }

    /**
     * 添加分类
     * @desc 添加书签分类
     *
     * @exception 400 参数不匹配
     */
    public function addClass()
    {

    }

    /**
     * 删除分类
     * @desc 删除指定分类
     *
     * @exception 400 参数不匹配
     */
    public function deleteClass()
    {

    }

    /**
     * 修改分类
     * @desc 修改指定分类
     *
     * @exception 400 参数不匹配
     */
    public function modifyClass()
    {

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
        return ["count" => 0];
    }
}