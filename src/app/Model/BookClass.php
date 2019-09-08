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

    public function getTableName($id)
    {
        return 'book_class';
    }

    /**
     * @param $parent_id
     * @param $name
     * @return string
     */
    public function addClass($parent_id, $name)
    {
        $data = array(self::KEY_PARENT_ID => $parent_id, self::KEY_NAME => $name, self::KEY_CREATE_AT => time());

        $orm = $this->getORM();
        $orm->insert($data);

        return $orm->insert_id();
    }

    /**
     * 删除指定分类.
     *
     * @param int $id 分类id.
     * @return bool|int
     * @throws \Exception
     */
    public function deleteClass($id)
    {
        return $this->getORM()->where(self::KEY_ID, $id)->delete();
    }

    /**
     * 获取某个分类下子分类的数量.
     *
     * @param int $id 指定 id
     * @return int
     */
    public function getCount($id)
    {
        return $this->getORM()->where(self::KEY_PARENT_ID, $id)->count();
    }

    /**
     * 更新指定分类.
     *
     * @param int $id 分类id.
     * @param int $parent_id 父类id
     * @param string $name 分类名称
     * @return false|int
     */
    public function updateClass($id, $parent_id, $name)
    {
        $orm = $this->getORM();
        $data = array(
            self::KEY_PARENT_ID => $parent_id,
            self::KEY_NAME => $name,
            self::KEY_MODIFY_AT => time()
        );

        return $orm->where(self::KEY_ID, $id)->update($data);
    }

    /**
     * 判断是否存在指定分类.
     *
     * @param $id
     * @return bool
     */
    public function exists($id)
    {
        $orm = $this->getORM();
        $count = $orm->where(self::KEY_ID, $id)->count();

        return $count > 0;
    }
}