<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-08-30
 * Time: 10:08
 */
namespace App\Api;

use PhalApi\Api;
use App\Domain\BookMark as Domain_BookMark;

/**
 * 书签
 * @package App\Api
 */
class BookMark extends Api
{
    public function getRules()
    {
        return array(
            'getAllBookMark' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            ),
            'addBookMark' => array(
                'class_id' => array('name'  => 'class_id', 'type' => 'int', 'require' => true, 'desc' => '书签分类id'),
                'name' => array('name' => 'name', 'type' => 'string', 'require' => true, 'desc' => '书签名称'),
                'url' => array('name' => 'url', 'regex' => '/[\w]+:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is', 'require' => true, 'desc' => '书签地址'),
                'icon' => array('name' => 'icon', 'type' => 'string', 'desc' => '网站图标'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            ),
            'deleteBookMark' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '书签 id'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            ),
            'modifyBookMark' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '书签 id'),
                'name' => array('name' => 'name', 'type' => 'string', 'desc' => '书签名称'),
                'url' => array('name' => 'url', 'regex' => '/[\w]+:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is', 'desc' => '书签地址'),
                'class_id' => array('name' => 'class_id', 'type' => 'int', 'default' => 0, 'desc' => '书签分类id'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            ),
            'increaseReadCount' => array(
                'id' => array('name' => 'id', 'type' => 'int', 'require' => true, 'desc' => '书签 id'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            ),
            'readCountTop' => array(
                'count' => array('name' => 'count', 'type' => 'int', 'default' => 10, 'desc' => '需要获取的数量，默认为10条'),
                'class_id' => array('name' => 'class_id', 'type' => 'int', 'default' => 0, 'desc' => '需要获取的分类，默认为获取所有分类下的数据'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            ),
            'getBookMarkFromClass' => array(
                'class_id' => array('name' => 'class_id', 'type' => 'int', 'default' => 0, 'require' => true, 'desc' => '书签分类id'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
            ),
            'getAllBookMarkAndBookClass' => array(
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => 'token')
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
        return (new Domain_BookMark())->getAllBookMark();
    }

    /**
     * 添加书签
     * @desc 在指定分类下，添加一条书签
     *
     * @exception 400 参数不匹配
     * @exception 1006 分类不存在
     * @exception 1007 URL已经存在
     * @exception 10001 添加失败
     *
     */
    public function addBookMark()
    {
        $domain_bookmark = new Domain_BookMark();
        $insert_id = $domain_bookmark->addBookMark($this->class_id, $this->name, $this->url, $this->icon);
        return ['id' => $insert_id];
    }

    /**
     * 删除书签
     * @desc 删除指定 id 的书签
     *
     * @exception 400 参数不匹配
     * @exception 1004 删除失败
     */
    public function deleteBookMark()
    {
        $domain_bookmark = new Domain_BookMark();
        $domain_bookmark->deleteBookMark($this->id);
    }

    /**
     * 更新书签
     * @desc 通过 id 更新书签
     *
     * @exception 400 参数不匹配
     */
    public function modifyBookMark()
    {
        (new Domain_BookMark())->updateBookMark(
            $this->id,
            $this->name,
            $this->url,
            $this->class_id
        );
    }

    /**
     * 增加书签的点击次数
     * @desc 通过 id 来递增书签的点击次数
     *
     * @exception 400 参数不匹配
     */
    public function increaseReadCount()
    {
        (new Domain_BookMark())->increaseReadCount($this->id);
    }

    /**
     * 获取点击数最高的文章
     * @desc 获取点击数最高的文章
     *
     * @return array bookmarks 获取到的书签列表
     */
    public function readCountTop()
    {
        $data = (new Domain_BookMark())->getClassTopRead($this->class_id, $this->count);
        return $data;
    }

    /**
     * 获取分类下的书签数据
     * @desc 获取指定分类下的所有书签以及分类
     *
     * @return array bookmark 书签列表
     */
    public function getBookMarkFromClass()
    {
        return (new Domain_BookMark())->getBookMarkFromClass($this->class_id);
    }

    /**
     * 获取所有分类和书签.
     *
     * @return mixed
     */
    public function getAllBookMarkAndBookClass()
    {
        return (new Domain_BookMark())->getBookMarkAndClass();
    }
}