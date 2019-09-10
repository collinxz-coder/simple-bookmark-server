<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-09
 * Time: 11:32
 */

namespace App\Domain;

use \App\Model\EmailCode as Model_EmailCode;

class EmailCode
{
    public function generateCode()
    {
        return rand(10000, 99999);
    }

    /**
     * 添加新的 code.
     *
     * @param $email
     * @return int
     */
    public function addEmailCode($email)
    {
        $code = $this->generateCode();

        $model = new Model_EmailCode();
        $model->insert($email, $code);

        return $code;
    }
}