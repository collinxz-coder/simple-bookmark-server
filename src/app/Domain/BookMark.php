<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-08
 * Time: 23:43
 */

namespace App\Domain;

use App\Model\BookMark as Model_BookMark;
use App\Model\BookClass as Model_BookClass;
use PhalApi\Exception\BadRequestException;

class BookMark
{
    private $user_id;

    public function __construct()
    {
        $this->user_id = \PhalApi\DI()->request->user_id;
    }

    /**
     * 获取所有的书签
     * @return mixed
     */
    public function getAllBookMark()
    {
        $model_bookmark = new Model_BookMark();
        return $model_bookmark->getAllBookMark($this->user_id);
    }

    /**
     * 添加书签.
     *
     * @param int $class_id 分类id
     * @param string $mark_name 书签名称
     * @param string $url 书签url
     * @param string $icon 图标地址
     * @throws BadRequestException
     */
    public function addBookMark($class_id, $mark_name, $url, $icon)
    {
        $model_bookmark = new Model_BookMark();
        $model_bookclass = new Model_BookClass();

        if (! $model_bookclass->exists($this->user_id, $class_id)) {
            throw new BadRequestException(ERROR_MSG[CLASS_NOT_EXISTS], CLASS_NOT_EXISTS);
        }


        if ($model_bookmark->urlExists($url, $this->user_id)) {
            throw new BadRequestException(ERROR_MSG[URL_EXISTS], URL_EXISTS);
        }

        $res = $model_bookmark->addBookMark($this->user_id, $class_id, $mark_name, $url, $icon);
        if (! $res) {
            throw new BadRequestException(ERROR_MSG[INSERT_ERROR], INSERT_ERROR);
        }
    }

    /**
     * 删除指定书签
     *
     * @param int $id 要删除的书签
     * @throws BadRequestException
     */
    public function deleteBookMark($id)
    {
        $model_bookmark = new Model_BookMark();
        if (! $model_bookmark->deleteBookMark($id, $this->user_id)) {
            throw new BadRequestException(ERROR_MSG[DELETE_ERROR], DELETE_ERROR);
        }
    }

    /**
     * 修改指定书签
     *
     * @param int $id 要修改的书签
     * @param string $name 书签名称
     * @param string $url 书签地址
     * @param int $class_id 书签分类id
     * @throws BadRequestException
     */
    public function updateBookMark($id, $name, $url, $class_id)
    {
        $model_bookmark = new Model_BookMark();
        $model_bookclass = new Model_BookClass();

        if (!empty($class_id) && !$model_bookclass->exists($this->user_id, $class_id)) {
            throw new BadRequestException(ERROR_MSG[CLASS_NOT_EXISTS], CLASS_NOT_EXISTS);
        }

        if ($model_bookmark->updateBookMark($this->user_id, $id, $name, $url, $class_id) === false) {
            throw new BadRequestException(ERROR_MSG[UPDATE_ERROR], UPDATE_ERROR);
        }
    }

    /**
     * 获取指定分类下的所有书签.
     *
     * @param int $class_id 要获取的分类.
     * @return mixed
     */
    public function getBookMarkFromClass($class_id)
    {
        return (new Model_BookMark())->getBookMarkFromClass($this->user_id, $class_id);
    }

    /**
     * 阅读数自增.
     *
     * @param int $id 书签id
     * @throws BadRequestException
     */
    public function increaseReadCount($id)
    {
        $model = new Model_BookMark();

        if (! $model->increaseReadCount($this->user_id, $id)) {
            throw new BadRequestException(ERROR_MSG[UPDATE_ERROR], UPDATE_ERROR);
        }
    }

    public function getClassTopRead($class_id, $count)
    {
        $model = new Model_BookMark();
        return $model->getTopByReadCount($this->user_id, $class_id, $count);
    }

    /**
     * 获取所有分类和书签。
     *
     * @return mixed
     */
    public function getBookMarkAndClass()
    {
        $model_book_mark = new Model_BookMark();
        $model_book_class = new Model_BookClass();

        $class = $model_book_class->getUserAllClass($this->user_id);
        foreach ($class as &$value) {
            $value['type'] = 'dir';
            $class_id = $value['id'];
            $marks = $model_book_mark->getBookMarkFromClass($this->user_id, $class_id);
            foreach ($marks as &$mark) {
                $mark['type'] = 'link';
                $mark['name'] = $mark['mark_name'];
                $mark['id'] = "mark_" . $mark["id"];
            }
            $value['children'] = $marks;
        }

        return $class;
    }
}