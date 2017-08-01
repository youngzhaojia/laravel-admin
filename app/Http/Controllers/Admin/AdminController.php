<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/13  下午9:39
 */

namespace App\Http\Controllers\Admin;

use App\Common\BaseAdminController;
use App\Models\Admin;
use App\Repos\AdminRepo;
use App\Repos\AdminRoleRepo;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
class AdminController extends BaseAdminController
{
    protected $adminRepo;
    protected $roleRepo;

    public function __construct(AdminRepo $adminRepo, AdminRoleRepo $roleRepo)
    {
        $this->adminRepo = $adminRepo;
        $this->roleRepo  = $roleRepo;
    }

    public function index()
    {
        return view('admin.admin.index');
    }

    public function create()
    {
        $roleAll = $this->roleRepo->getAll();
        $roles = [];
        return view('admin.admin.create', compact('roleAll', 'roles'));
    }

    public function update($id = 0)
    {
        $roleAll = $this->roleRepo->getAll();

        $admin = $this->adminRepo->getById($id);
        $roles = [];
        foreach ($admin->roles as $role) {
            $roles[] = $role->id;
        }
        return view('admin.admin.update', compact('admin', 'roleAll', 'roles'));
    }

    public function detail($id = 0)
    {
        $admin = $this->adminRepo->find($id);
        if ($admin instanceof Admin) {
            return view('admin.admin.detail', compact('admin'));
        }
        return redirect()->route('admin.admin.list');
    }
}