<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/6  下午8:16
 */

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_admin_role', 'admin_id', 'role_id');
    }

    // 判断用户是否具有某个角色
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !!$role->intersect($this->roles)->count();
    }

    // 判断用户是否具有某权限
    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            $permission = AdminPermission::where('name',$permission)->first();
            if (!$permission) return false;
        }

        return $this->hasRole($permission->roles);
    }





//    public function roles()
//    {
//        return $this->belongsTo(Role::class);
//    }
//
//    public function hasRole($name)
//    {
//
//    }
//
//    public function setRole($name)
//    {
//
//    }
//
//    public function hasPermission($name)
//    {
//        if (!$this->relationLoaded('role')) {
//            $this->load('role');
//        }
//
//        if (!$this->role->relationLoaded('permissions')) {
//            $this->role->load('permissions');
//        }
//
//        return in_array($name, $this->role->permissions->pluck('key')->toArray());
//    }
//
//    public function hasPermissionOrFail($name)
//    {
//        if (!$this->hasPermission($name)) {
//            throw new UnauthorizedHttpException(null);
//        }
//
//        return true;
//    }
//
//    public function hasPermissionOrAbort($name, $statusCode = 403)
//    {
//        if (!$this->hasPermission($name)) {
//            return abort($statusCode);
//        }
//
//        return true;
//    }
}