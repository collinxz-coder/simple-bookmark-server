<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2019-09-11
 * Time: 10:45
 */

namespace App\Common;

use App\Model\Token;
use PhalApi\Exception\BadRequestException;
use PhalApi\Filter;

class SignJwt implements Filter
{
    public function check()
    {
        $token = \PhalApi\DI()->request->get('token');

        $model_token = new Token();
        if (! $model_token->checkToken($token)) {
            throw new BadRequestException('Error Token', 1);
        }

        $res = \PhalApi\DI()->jwt->decodeJwtByParam($token);

        \PhalApi\DI()->request->user_id = $res['user_id'];
        \PhalApi\DI()->request->user_name = $res['user_name'];
    }
}