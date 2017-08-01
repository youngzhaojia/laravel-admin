<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/30  下午4:49
 */

namespace App\Http\Controllers\Api;

use App\Common\BaseApiController;
use App\Http\Requests\RoleSaveRequest;
use App\Repos\AdminRoleRepo;
use Illuminate\Http\Request;

/**
 * Class RoleController
 * @package App\Http\Controllers\Api
 */
class RoleController extends BaseApiController
{
    protected $roleRepo;

    public function __construct(AdminRoleRepo $adminRoleRepo)
    {
        $this->roleRepo = $adminRoleRepo;
    }

    public function index(Request $request)
    {
        $roles = $this->roleRepo->getList($request->all());
        return $this->success($roles);
    }

    public function save(RoleSaveRequest $request)
    {
        $rs = $this->roleRepo->savePostData($request->all());
        if ($rs) {
            return $this->success($rs);
        }
        return $this->error('保存失败');
    }

    public function delete(Request $request)
    {
        $rs = $this->roleRepo->deleteById($request->get('id'));
        if ($rs) {
            return $this->success();
        }
        return $this->error('删除失败');
    }
}