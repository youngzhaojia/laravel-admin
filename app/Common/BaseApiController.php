<?php

/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/13  下午10:42
 */

namespace App\Common;

use App\Http\Controllers\Controller;

/**
 * Class BaseApiController
 * @package App\Common
 */
class BaseApiController extends Controller
{
    /**
     * @param array $data
     * @param string $msg
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data = [], $msg = 'success')
    {
        if (is_string($data)) {
            $msg = $data;
        }
        $resp = [
            'code' => 0,
            'msg'  => $msg,
            'data' => $data,
        ];
        return response()->json($resp);
    }

    /**
     * @param string $msg
     * @param int $code
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($msg = 'error', $code = Error::ERR_GENERAL, $data = [])
    {
        $resp = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];
        return response()->json($resp);
    }
}