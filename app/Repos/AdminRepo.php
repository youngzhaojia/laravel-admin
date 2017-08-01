<?php

/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/13  上午00:29
 */
namespace App\Repos;

use App\Common\MyPaginator;
use App\Models\Admin;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;

class AdminRepo extends BaseRepository
{
    /**
     * Specify Model class name
     * @return string
     */
    function model()
    {
        return "App\\Models\\Admin";
    }

    public $page_size = 20;

    public function getList($params = array())
    {
        $page_size = $params['page_size'] ?? $this->page_size;
        $page_size = 5;

        $finder = DB::table('admins');
        $finder->when($params['name'], function ($query) use ($params) {
            return $query->where('name', 'like', '%' . $params['name'] . '%');
        });

        $pg = new MyPaginator($finder, $finder->count(), $page_size);

        $admins = $finder->orderBy('id', 'desc')
            ->offset($pg->getOffset())
            ->limit($pg->getLimit())
            ->get();
        return [
            'admins' => $admins,
            'pg' => $pg->toArray(),
        ];
    }

    /**
     * @param $data
     * @return bool|string
     */
    public function savePostData($data)
    {
        $roles = $data['roles'] ?? [];

        unset($data['roles']);
        if (empty($data['id'])) {
            $data['password'] = bcrypt('123456');
            $admin = $this->create($data);
            if (($admin instanceof Admin) && count($roles) > 0) {
                $admin->roles()->sync($roles);
            }
            return '创建成功';
        } else {
            $admin = $this->update($data, $data['id']);
            if (($admin instanceof Admin) && count($roles) > 0) {
                $admin->roles()->sync($roles);
            }
            return '更新成功';
        }
    }

    public function getById($id = 0)
    {
        return $this->with(['roles'])->find($id);
    }
}