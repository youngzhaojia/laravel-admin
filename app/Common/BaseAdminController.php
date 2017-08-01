<?php

/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/6  下午10:28
 */
namespace App\Common;

use App\Http\Controllers\Controller;

class BaseAdminController extends Controller
{
    public function getAdmin()
    {
        return Auth()->guard('admin')->user();
    }

    public function getAdminId()
    {
        return Auth()->guard('admin')->id();
    }
}