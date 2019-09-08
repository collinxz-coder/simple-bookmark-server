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
    const KEY_CLASS_ID = 'class_id';

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
}