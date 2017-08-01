<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/27  下午10:46
 */

namespace App\Repos;

use App\Common\MyPaginator;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;

/**
 * Class AdminPermissionRepo
 * @package App\Repos
 */
class AdminPermissionRepo extends BaseRepository
{
    /**
     * Specify Model class name
     * @return string
     */
    function model()
    {
        return "App\\Models\\AdminPermission";
    }

    public $page_size = 20;

    /**
     * @param array $params
     * @return array
     */
    public function getList($params = array())
    {
        $page_size = $params['page_size'] ?? $this->page_size;

        if (!isset($params['cid'])) {
            $params['cid'] = 0;
        }

        $finder = DB::table('admin_permissions');
        $finder->when($params['name'], function ($query) use ($params) {
            return $query->where('name', 'like', '%' . $params['name'] . '%');
        });
        $finder->when(isset($params['cid']), function ($query) use ($params) {
            return $query->where('cid','=', $params['cid']);
        });

        $pg = new MyPaginator($finder, $finder->count(), $page_size);

        $permissions = $finder->orderBy('id', 'desc')
            ->offset($pg->getOffset())
            ->limit($pg->getLimit())
            ->get();

        return [
            'permissions' => $permissions,
            'pg'          => $pg->toArray(),
        ];
    }

    public function getAll()
    {
        $permissions = $this->all()->toArray();

        $permissionAll = [];
        foreach ($permissions as $p) {
            $permissionAll[$p['cid']][] = $p;
        }
        return $permissionAll;
    }
}