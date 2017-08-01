<?php

/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/6  下午11:56
 */

namespace App\Http\Controllers\Admin;

use App\Common\BaseAdminController;

class IndexController extends BaseAdminController
{
    public function index()
    {
        return view('admin.index.index');
    }
}