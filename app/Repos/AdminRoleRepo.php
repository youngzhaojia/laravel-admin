<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/31  下午5:27
 */

namespace App\Repos;

use App\Common\MyPaginator;
use App\Models\AdminRole;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;

/**
 * Class AdminRoleRepo
 * @package App\Repos
 */
class AdminRoleRepo extends BaseRepository
{
    public function model()
    {
        return "App\\Models\\AdminRole";
    }

    public $page_size = 20;

    public function getList($params = array())
    {
        $page_size = $params['page_size'] ?? $this->page_size;

        $finder = DB::table('admin_roles');
        $finder->when($params['name'], function ($query) use ($params) {
            return $query->where('name', 'like', '%' . $params['name'] . '%');
        });

        $pg = new MyPaginator($finder, $finder->count(), $page_size);

        $roles = $finder->orderBy('id', 'desc')
            ->offset($pg->getOffset())
            ->limit($pg->getLimit())
            ->get();
        return [
            'roles' => $roles,
            'pg'    => $pg->toArray(),
        ];
    }

    public function getAll()
    {
        return $this->all()->toArray();
    }

    /**
     * @param $data
     * @return string
     */
    public function savePostData($data)
    {
        $permissions = $data['permissions'] ?? [];

        unset($data['permissions']);
        if (empty($data['id'])) {
            $role = $this->create($data);
            if (($role instanceof AdminRole) && count($permissions) > 0) {
                $role->permissions()->sync($permissions);
            }
            return '创建成功';
        } else {
            $role = $this->update($data, $data['id']);
            if (($role instanceof AdminRole) && count($permissions) > 0) {
                $role->permissions()->sync($permissions);
            }
            return '更新成功';
        }
    }

    public function getById($id = 0)
    {
        return $this->with(['permissions'])->find($id);
    }

    public function deleteById($id = 0)
    {
        $role = $this->getById($id);

        foreach ($role->permissions as $v) {
            $role->permissions()->detach($v);
        }
        $this->delete($id);
        return true;
    }
}