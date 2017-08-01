<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/30  下午3:47
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminRole
 * @package App\Models
 */
class AdminRole extends Model
{
    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class, 'admin_permission_role', 'role_id', 'permission_id');
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_admin_role', 'role_id', 'admin_id');
    }
}