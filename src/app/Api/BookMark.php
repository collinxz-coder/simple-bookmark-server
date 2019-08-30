<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-08-30
 * Time: 10:08
 */
namespace App\Api;

use PhalApi\Api;

/**
 * 书签
 * @package App\Api
 */
class BookMark extends Api
{
    public function getRules()
    {
        return array(
            'addBookMark' => array(
                'class_id' => array('name'  => 'class_id', 'type' => 'int', 'require' => true, 'desc' => '书签分类id'),
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '书签名称'),
                'url' => array('name' => 'url', 'regex' => '/[\w]+:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is', 'require' => true, 'desc' => '书签地址')
            ),
            'deleteBookMark' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '书签 id'),
            ),
            'modifyBookMark' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '书签 id'),
                'name' => array('name' => 'name', 'type' => 'string', 'desc' => '书签名称'),
                'url' => array('name' => 'url', 'regex' => '/[\w]+:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is', 'desc' => '书签地址')
            ),
            'increaseReadCount' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '书签 id'),
            ),
            'readCountTop' => array(
                'count' => array('name' => 'count', 'type' => 'int', 'default' => 10, 'desc' => '需要获取的数量，默认为10条'),
                'class_id' => array('name' => 'class_id', 'type' => 'int', 'default' => 0, 'desc' => '需要获取的分类，默认为获取所有分类下的数据')
            )
        );
    }

    /**
     * 获取所有的书签
     * @desc 获取当前用的的所有书签和分类
     *
     * @return array bookmarks 书签列表
     *
     */
    public function getAllBookMark()
    {
        return [];
    }

    /**
     * 添加书签
     * @desc 在指定分类下，添加一条书签
     *
     * @exception 400 参数不匹配
     * @exception 1000 数据已经存在
     *
     */
    public function addBookMark()
    {

    }

    /**
     * 删除书签
     * @desc 删除指定 id 的书签
     *
     * @exception 400 参数不匹配
     */
    public function deleteBookMark()
    {

    }

    /**
     * 更新书签
     * @desc 通过 id 更新书签
     *
     * @exception 400 参数不匹配
     */
    public function modifyBookMark()
    {

    }

    /**
     * 增加书签的点击次数
     * @desc 通过 id 来递增书签的点击次数
     *
     * @exception 400 参数不匹配
     */
    public function increaseReadCount()
    {

    }

    /**
     * 获取点击数最高的文章
     * @desc 获取点击数最高的文章
     *
     * @return array bookmarks 获取到的书签列表
     */
    public function readCountTop()
    {

    }

    /**
     * 获取分类下的书签数据
     * @desc 获取指定分类下的所有书签以及分类
     *
     * @return array bookmark 书签列表
     */
    public function getBookMarkFromClass()
    {
        return [];
    }
}