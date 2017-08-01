<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/26  下午8:47
 */

namespace App\Common;

use Illuminate\Contracts\Validation\Validator;

/**
 * Trait BaseApiRequest
 * @package App\Common
 */
trait BaseApiRequest
{
    protected function formatErrors(Validator $validator)
    {
        $message = $validator->getMessageBag()->first();
        $resp = [
            'code' => Error::ERR_GENERAL,
            'msg'  => $message,
            'data' => '',
        ];
        return $resp;
    }

    public function response(array $errors)
    {
        return response()->json($errors);
    }
}