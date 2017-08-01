<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/26  下午8:10
 */

namespace App\Http\Controllers\Api;

use App\Common\BaseApiController;
use App\Http\Requests\PermissionSaveRequest;
use App\Repos\AdminPermissionRepo;
use Illuminate\Http\Request;

/**
 * Class PermissionController
 * @package App\Http\Controllers\Api
 */
class PermissionController extends BaseApiController
{
    protected $adminPermissionRepo;

    public function __construct(AdminPermissionRepo $adminPermissionRepo)
    {
        $this->adminPermissionRepo = $adminPermissionRepo;
    }

    public function index(Request $request)
    {
        $permissions = $this->adminPermissionRepo->getList($request->all());
        return $this->success($permissions);
    }

    public function save(PermissionSaveRequest $request)
    {
        $data = $request->all();
        if (empty($data['id'])) {
            $rs = $this->adminPermissionRepo->create($data);
            if ($rs) {
                return $this->success('创建成功');
            }
        } else {
            $rs = $this->adminPermissionRepo->update($data, $data['id']);
            if ($rs) {
                return $this->success('更新成功');
            }
        }
        return $this->error('保存失败');
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $this->adminPermissionRepo->delete($id);
        $this->success();
    }
}