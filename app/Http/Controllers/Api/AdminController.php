<?php

/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/13  下午8:42
 */

namespace App\Http\Controllers\Api;

use App\Common\BaseApiController;
use App\Http\Requests\AdminSaveRequest;
use App\Repos\AdminRepo;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers\Api
 */
class AdminController extends BaseApiController
{
    protected $adminRepo;

    public function __construct(AdminRepo $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function index(Request $request)
    {
        $admins = $this->adminRepo->getList($request->all());
        return $this->success($admins);
    }

    public function save(AdminSaveRequest $request)
    {
        $rs = $this->adminRepo->savePostData($request->all());
        if ($rs) {
            return $this->success($rs);
        }
        return $this->error('保存失败');
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $this->adminRepo->delete($id);
        $this->success();
    }
}