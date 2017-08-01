<?php
/**
 * Created by ZhaoJia.
 * Email: youngzhaojia@qq.com
 * Date: 2017/7/6  下午5:55
 */

namespace App\Exceptions;

use Illuminate\Http\Request;

trait AuthenticatesLogout
{
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->forget($this->guard()->getName());

        $request->session()->regenerate();

        return redirect('admin/login');
    }
}