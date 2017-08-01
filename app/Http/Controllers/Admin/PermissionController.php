<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/26  下午9:50
 */

namespace App\Http\Controllers\Admin;

use App\Common\BaseAdminController;
use App\Models\AdminPermission;

/**
 * Class PermissionController
 * @package App\Http\Controllers\Admin
 */
class PermissionController extends BaseAdminController
{
    public function index($cid = 0)
    {
        $data = [
            'cid' => $cid,
        ];

        if ($cid > 0) {
            $firstPermission = AdminPermission::find($cid);
            if ($firstPermission instanceof AdminPermission) {
                $data['firstPermission'] = $firstPermission;
            } else {
                return redirect()->route('admin.permission.list', ['cid' => 0]); //二级菜单没找到一级目录, 跳转列表
            }
        }
        return view('admin.permission.index', $data);
    }

    public function create($cid = 0)
    {
        return view('admin.permission.create', [
            'cid' => $cid,
        ]);
    }

    public function update($id = 0)
    {
        $permission = AdminPermission::find($id);
        if ($permission instanceof AdminPermission) {
            $cid = $permission->cid;
            return view('admin.permission.update', compact('permission', 'cid'));
        }
        return redirect()->route('admin.permission.list', ['cid' => 0]); //没找到该权限, 跳转列表
    }
}