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
    /**
     * 获取所有的书签
     * @return mixed
     */
    public function getAllBookMark()
    {
        $model_bookmark = new Model_BookMark();
        return $model_bookmark->getAllBookMark();
    }

    /**
     * 添加书签.
     *
     * @param int $class_id 分类id
     * @param string $mark_name 书签名称
     * @param string $url 书签url
     * @throws BadRequestException
     */
    public function addBookMark($class_id, $mark_name, $url)
    {
        $model_bookmark = new Model_BookMark();
        $model_bookclass = new Model_BookClass();

        if (! $model_bookclass->exists($class_id)) {
            throw new BadRequestException(ERROR_MSG[CLASS_NOT_EXISTS], CLASS_NOT_EXISTS);
        }


        if ($model_bookmark->urlExists($url)) {
            throw new BadRequestException(ERROR_MSG[URL_EXISTS], URL_EXISTS);
        }

        $res = $model_bookmark->addBookMark($class_id, $mark_name, $url);
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
        if ($model_bookmark->deleteBookMark($id)) {
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

        if (!empty($class_id) && !$model_bookclass->exists($class_id)) {
            throw new BadRequestException(ERROR_MSG[CLASS_NOT_EXISTS], CLASS_NOT_EXISTS);
        }

        if ($model_bookmark->updateBookMark($id, $name, $url, $class_id) === false) {
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
        return (new Model_BookMark())->getBookMarkFromClass($class_id);
    }
}