<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-08
 * Time: 21:34
 */
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class BookClass extends NotORM {
    const KEY_ID = 'id';
    const KEY_PARENT_ID = 'parent_id';
    const KEY_NAME = 'name';
    const KEY_MODIFY_AT = 'modify_at';
    const KEY_CREATE_AT = 'create_at';
    const KEY_USER_ID = 'user_id';

    public function getTableName($id)
    {
        return 'book_class';
    }

    /**
     * @param int $user_id 用户id
     * @param $parent_id
     * @param $name
     * @return string
     */
    public function addClass($user_id, $parent_id, $name)
    {
        $data = array(self::KEY_USER_ID => $user_id, self::KEY_PARENT_ID => $parent_id, self::KEY_NAME => $name, self::KEY_CREATE_AT => time());

        $orm = $this->getORM();
        $orm->insert($data);

        return $orm->insert_id();
    }

    /**
     * 删除指定分类.
     *
     * @param int $id 分类id.
     * @param int $user_id 用户id
     * @return bool|int
     * @throws \Exception
     */
    public function deleteClass($id, $user_id)
    {
        return $this->getORM()->where(self::KEY_ID, $id)->where(self::KEY_USER_ID, $user_id)->delete();
    }

    /**
     * 获取某个分类下子分类的数量.
     *
     * @param int $id 指定 id
     * @param int $user_id 用户id
     * @return int
     */
    public function getCount($id, $user_id)
    {
        return $this->getORM()->where(self::KEY_PARENT_ID, $id)->where(self::KEY_USER_ID, $user_id)->count();
    }

    /**
     * 更新指定分类.
     *
     * @param int $user_id 用户id.
     * @param int $id 分类id.
     * @param int $parent_id 父类id
     * @param string $name 分类名称
     * @return false|int
     */
    public function updateClass($user_id, $id, $parent_id, $name)
    {
        $orm = $this->getORM();
        $data = array(
            self::KEY_PARENT_ID => $parent_id,
            self::KEY_NAME => $name,
            self::KEY_MODIFY_AT => time()
        );

        return $orm->where(self::KEY_ID, $id)->where(self::KEY_USER_ID, $user_id)->update($data);
    }

    /**
     * 判断是否存在指定分类.
     *
     * @param $id
     * @return bool
     */
    public function exists($user_id, $id)
    {
        $orm = $this->getORM();
        $count = $orm->where(self::KEY_ID, $id)->where(self::KEY_USER_ID, $user_id)->count();

        return $count > 0;
    }

    /**
     * 获取用户所有的分类.
     *
     * @param int $user_id 用户id
     * @return mixed
     */
    public function getUserAllClass($user_id)
    {
        return $this->getORM()->where(self::KEY_USER_ID, $user_id)->fetchAll();
    }
}