<?php

/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/6  下午11:46
 */
namespace App\Http\Controllers\Admin;

use App\Common\BaseAdminController;
use App\Exceptions\AuthenticatesLogout;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends BaseAdminController
{
    use AuthenticatesUsers, AuthenticatesLogout {
        AuthenticatesLogout::logout insteadof AuthenticatesUsers; //防止前后台session都被清掉了
    }

    public function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'logout']);
    }


    public function showLoginForm()
    {
        return view('admin.login.login');
    }

    /**
     * 使用 admin guard
     */
    protected function guard()
    {
        return auth()->guard('admin');
    }

    /**
     * 重写验证时使用的用户名字段
     */
    public function username()
    {
        return 'name';
    }

    /*
     * Preempts $redirectTo member variable (from RedirectsUsers trait)
     */
    public function redirectTo()
    {
        return route('admin.index');
    }
}