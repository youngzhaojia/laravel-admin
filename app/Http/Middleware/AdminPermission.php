<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/8/1  上午1:43
 */

namespace App\Http\Middleware;

use Closure;
use Route, URL, Auth;

class AdminPermission
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
        if (isset(Auth::guard('admin')->user()->id) && Auth::guard('admin')->user()->id === 1) {
            return $next($request);
        }

        $previousUrl = URL::previous();
        $routeName = starts_with(Route::currentRouteName(), 'admin.') ? Route::currentRouteName() : 'admin.' . Route::currentRouteName();
        if (!\Gate::forUser(auth('admin')->user())->check($routeName)) {
            if ($request->ajax() && ($request->getMethod() != 'GET')) {
                return response()->json([
                    'status' => -1,
                    'code'   => 403,
                    'msg'    => '您没有权限执行此操作',
                ]);
            } else {
                return response()->view('admin.errors.403', compact('previousUrl'));
            }
        }

        return $next($request);
    }
}