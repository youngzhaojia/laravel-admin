<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/8/1  上午1:43
 */

namespace App\Http\Middleware;

use App\Models\AdminPermission;
use Closure;

class AdminMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->attributes->set('comData_menu', $this->getMenu());

        return $next($request);
    }

    public function getMenu()
    {
        $openArr = [];
        $data = [];
        $data['top'] = [];
        //查找并拼接出地址的别名值
        $path_arr = explode('/', \URL::getRequest()->path());
        if (isset($path_arr[1])) {
            $urlPath = $path_arr[0] . '.' . $path_arr[1] . '.list';
        } else {
            $urlPath = $path_arr[0] . '.list';
        }

        //查找出所有的地址
        $table = AdminPermission::where('name', 'LIKE', '%list')->orWhere('cid', 0)->get();
        foreach ($table as $v) {
            if ($v->cid == 0 || \Gate::forUser(auth('admin')->user())->check($v->name)) {
                if ($v->name == $urlPath) {
                    $openArr[] = $v->id;
                    $openArr[] = $v->cid;
                }
                $data[$v->cid][] = $v->toarray();
            }
        }
        foreach ($data[0] as $v) {
            if (isset($data[$v['id']]) && is_array($data[$v['id']]) && count($data[$v['id']]) > 0) {
                $data['top'][] = $v;
            }
        }
        unset($data[0]);
        //ation open 可以在函数中计算给他
        $data['openarr'] = array_unique($openArr);
        return $data;
    }
}