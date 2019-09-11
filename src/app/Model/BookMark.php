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
    const KEY_USER_ID = 'user_id';
    const KEY_READ_COUNT = 'read_count';

    public function getTableName($id)
    {
        return 'book_mark';
    }

    /**
     * 获取某个分类下书签的数量.
     *
     * @param int $class_id 分类id
     * @param int $user_id 用户id
     * @return int
     */
    public function getCount($class_id, $user_id)
    {
        return $this->getORM()->where(self::KEY_CLASS_ID, $class_id)->where(self::KEY_USER_ID, $user_id)->count();
    }

    /**
     * 获取所有的书签列表.
     *
     * @param int $user_id 用户id
     * @return mixed
     */
    public function getAllBookMark($user_id)
    {
        return $this->getORM()->where(self::KEY_USER_ID, $user_id)->fetchAll();
    }

    /**
     * 添加新的书签.
     *
     * @param int $user_id 用户id
     * @param int $class_id 分类id
     * @param string $mark_name 书签名称
     * @param string $url url地址
     * @return string
     */
    public function addBookMark($user_id, $class_id, $mark_name, $url)
    {
        $orm = $this->getORM();
        $data = array(
            self::KEY_CLASS_ID => $class_id,
            self::KEY_MARK_NAME => $mark_name,
            self::KEY_URL => $url,
            self::KEY_USER_ID => $user_id,
            self::KEY_CREATE_AT => time()
        );

        $orm->insert($data);

        return $orm->insert_id();
    }

    /**
     * 判断 url 是否存在.
     *
     * @param string $url 要判断的 url
     * @param int $user_id 用户id.
     * @return bool
     */
    public function urlExists($url, $user_id)
    {
        $orm = $this->getORM();
        $count = $orm->where(self::KEY_URL, $url)->where(self::KEY_USER_ID, $user_id)->count();

        return $count > 0;
    }

    /**
     * 删除指定的书签.
     *
     * @param int $id 要删除的id.
     * @param int $user_id 用户id.
     * @return bool|int
     * @throws \Exception
     */
    public function deleteBookMark($id, $user_id)
    {
        $orm = $this->getORM();
        return $orm->where(self::KEY_ID, $id)->where(self::KEY_USER_ID, $user_id)->delete();
    }

    /**
     * 修改指定书签.
     *
     * @param int $user_id 用户id
     * @param int $id 要修改的书签
     * @param string $name 书签
     * @param string $url 书签地址
     * @param $class_id 分类id
     * @return int
     */
    public function updateBookMark($user_id, $id, $name, $url, $class_id)
    {
        $orm = $this->getORM();
        $data = array();
        !empty($name) && $data[self::KEY_MARK_NAME] = $name;
        !empty($url) &&  $data[self::KEY_URL] = $url;
        !empty($class_id) && $data[self::KEY_CLASS_ID] = $class_id;

        if (!empty($data)) {
            $data[self::KEY_MODIFY_AT] = time();
            return $orm->where(self::KEY_ID, $id)->where(self::KEY_USER_ID, $user_id)->update($data);
        }

        return 0;
    }


    /**
     * 获取分类下的所有书签.
     *
     * @param int $user_id 用户id
     * @param int $class_id 要获取的分类id
     * @return mixed
     */
    public function getBookMarkFromClass($user_id, $class_id)
    {
        $orm = $this->getORM();
        return $orm->where(self::KEY_CLASS_ID, $class_id)->where(self::KEY_USER_ID, $user_id)->fetchAll();
    }

    /**
     * 更新点击次数.
     *
     * @param int $user_id 用户id
     * @param int $id 书签id
     * @return int
     */
    public function increaseReadCount($user_id, $id)
    {
        $prefix = \PhalApi\DI()->config->get('dbs.tables.__default__.prefix');
        $orm = $this->getORM();

        $table_name = $this->getTableName(0);
        $read_count = self::KEY_READ_COUNT;
        $key_id = self::KEY_ID;
        $key_user_id = self::KEY_USER_ID;

        $sql = "update {$prefix}{$table_name} set {$read_count} = {$read_count} + 1 where {$key_id} = ? and {$key_user_id} = ?";
        $params = array($id, $user_id);

        return $orm->executeSql($sql, $params);
    }

    /**
     * 获取用户点击量最高的书签.
     *
     * @param int $user_id 用户id
     * @param int $class_id 分类id
     * @param int $count 需要获取的数量
     * @return mixed
     */
    public function getTopByReadCount($user_id, $class_id, $count)
    {
        $orm = $this->getORM();
        return $orm->where(self::KEY_USER_ID, $user_id)->where(self::KEY_CLASS_ID, $class_id)->order(self::KEY_READ_COUNT . " DESC")->limit($count)->fetchAll();
    }
}