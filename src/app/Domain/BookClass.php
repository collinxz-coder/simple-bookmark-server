<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-08
 * Time: 21:40
 */
namespace App\Domain;

use App\Model\BookClass as Model_BookClass;
use App\Model\BookMark as Model_BookMark;
use \PhalApi\Exception\BadRequestException;

class BookClass
{
    private $user_id;

    public function __construct()
    {
        $this->user_id = \PhalApi\DI()->request->user_id;
    }

    /**
     * 添加书签分类.
     *
     * @param string $name 分类名称
     * @param int $parent_id 父级分类id.
     * @throws \PhalApi\Exception\BadRequestException
     */
    public function addClass($name, $parent_id = 0)
    {
        $model = new Model_BookClass();
        $insert_id = $model->addClass($this->user_id ,$parent_id, $name);

        if (!$insert_id) {
            throw new BadRequestException(ERROR_MSG[INSERT_ERROR], INSERT_ERROR);
        }
    }

    /**
     * 删除指定分类(如果还有子分类或者书签，则删除失败)。
     *
     * @param int $id 需要删除的分类.
     * @throws BadRequestException
     */
    public function deleteClass($id) {
        $model = new Model_BookClass();
        $child_class = $model->getCount($id, $this->user_id);

        if ($child_class) {
            throw new BadRequestException(ERROR_MSG[NOT_EMPTY_CLASS], NOT_EMPTY_CLASS);
        }

        $model_bookmark = new Model_BookMark();
        $bookmark_count = $model_bookmark->getCount($id);
        if ($bookmark_count) {
            throw new BadRequestException(ERROR_MSG[NOT_EMPTY_MARK], NOT_EMPTY_MARK);
        }


        if (! $model->delete($id)) {
            throw new BadRequestException(ERROR_MSG[DELETE_ERROR], DELETE_ERROR);
        }
    }

    /**
     * 修改指定分类.
     *
     * @param int $id 分类id
     * @param int $parent_id 父类id
     * @param string $name 分类名称
     * @throws BadRequestException
     */
    public function updateClass($id, $parent_id, $name)
    {
        $model = new Model_BookClass();

        $res = $model->updateClass($this->user_id, $id, $parent_id, $name);

        if ($res === false) {
            throw new BadRequestException(ERROR_MSG[UPDATE_ERROR], UPDATE_ERROR);
        }
    }

    /**
     * 获取指定分类下的子分类的数量.
     *
     * @param int $id id分类列表
     * @return int
     */
    public function getCount($id)
    {
        $model = new Model_BookClass();

        return $model->getCount($id, $this->user_id);
    }
}