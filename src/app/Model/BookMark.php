<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-08
 * Time: 22:14
 */
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class BookMark extends NotORM
{
    const KEY_ID = 'id';
    const KEY_MARK_NAME = 'mark_name';
    const KEY_URL = 'url';
    const KEY_CLASS_ID = 'class_id';
    const KEY_CREATE_AT = 'create_at';
    const KEY_MODIFY_AT = 'modify_at';

    public function getTableName($id)
    {
        return 'book_mark';
    }

    /**
     * 获取某个分类下书签的数量.
     *
     * @param int $class_id 分类id
     * @return int
     */
    public function getCount($class_id)
    {
        return $this->getORM()->where(self::KEY_CLASS_ID, $class_id)->count();
    }

    /**
     * 获取所有的书签列表.
     *
     * @return mixed
     */
    public function getAllBookMark()
    {
        return $this->getORM()->fetchAll();
    }

    /**
     * 添加新的书签.
     *
     * @param int $class_id 分类id
     * @param string $mark_name 书签名称
     * @param string $url url地址
     * @return string
     */
    public function addBookMark($class_id, $mark_name, $url)
    {
        $orm = $this->getORM();
        $data = array(
            self::KEY_CLASS_ID => $class_id,
            self::KEY_MARK_NAME => $mark_name,
            self::KEY_URL => $url,
        );

        $orm->insert($data);

        return $orm->insert_id();
    }

    /**
     * 判断 url 是否存在.
     *
     * @param string $url 要判断的 url
     * @return bool
     */
    public function urlExists($url)
    {
        $orm = $this->getORM();
        $count = $orm->where(self::KEY_URL, $url)->count();

        return $count > 0;
    }

    /**
     * 删除指定的书签.
     *
     * @param int $id 要删除的id.
     * @return bool|int
     * @throws \Exception
     */
    public function deleteBookMark($id)
    {
        $orm = $this->getORM();
        return $orm->where(self::KEY_ID, $id)->delete();
    }

    /**
     * 修改指定书签.
     *
     * @param int $id 要修改的书签
     * @param string $name 书签
     * @param string $url 书签地址
     * @param $class_id 分类id
     * @return int
     */
    public function updateBookMark($id, $name, $url, $class_id)
    {
        $orm = $this->getORM();
        $data = array(
            self::KEY_MARK_NAME => $name,
            self::KEY_URL => $url,
            self::KEY_CLASS_ID => $class_id,
            self::KEY_MODIFY_AT => time()
        );

        return $orm->where(self::KEY_ID, $id)->update($data);
    }


    /**
     * 获取分类下的所有书签.
     *
     * @param int $class_id 要获取的分类id
     * @return mixed
     */
    public function getBookMarkFromClass($class_id)
    {
        $orm = $this->getORM();
        return $orm->where(self::KEY_CLASS_ID, $class_id)->fetchAll();
    }
}