<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/30  下午3:45
 */

namespace App\Http\Controllers\Admin;

use App\Common\BaseAdminController;
use App\Repos\AdminPermissionRepo;
use App\Repos\AdminRoleRepo;

/**
 * Class RoleController
 * @package App\Http\Controllers\Admin
 */
class RoleController extends BaseAdminController
{
    protected $permissionRepo;
    protected $roleRepo;

    public function __construct(AdminPermissionRepo $permissionRepo, AdminRoleRepo $roleRepo)
    {
        $this->permissionRepo = $permissionRepo;
        $this->roleRepo       = $roleRepo;
    }

    public function index()
    {
        return view('admin.role.index');
    }

    public function create()
    {
        $permissionAll = $this->permissionRepo->getAll();
        $permissions = [];
        return view('admin.role.create', compact('permissionAll', 'permissions'));
    }

    public function update($id = 0)
    {
        //所有权限
        $permissionAll = $this->permissionRepo->getAll();

        $role = $this->roleRepo->getById($id);
        $permissions = [];
        foreach ($role->permissions as $permission) {
            $permissions[] = $permission->id;
        }

        return view('admin.role.update', compact('role', 'permissionAll', 'permissions'));
    }
}