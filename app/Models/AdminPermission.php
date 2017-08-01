<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/27  下午10:48
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminPermission
 * @package App\Models
 */
class AdminPermission extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'label', 'cid', 'icon', 'description'
    ];

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_permission_role', 'permission_id', 'role_id');
    }
}