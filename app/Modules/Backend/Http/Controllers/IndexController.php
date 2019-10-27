<?php
namespace App\Modules\Backend\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Modules\Backend\Http\Requests\LoginRequest;

class IndexController extends Controller
{
    public function __construct()
    {
        
	}

    /**
     * 后台首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend::index.index');
    }

    /**
     * 登录页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginPage()
    {
        return view('backend::index.login');
    }

    /**
     * 登录
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'name' => $request->get('username'),
            'password' => $request->get('password'),
            'deleted_at' => null,
        ])) {
            return Redirect::intended('/admin');
        }else {
            return Redirect::back()->withErrors("用户名或密码不正确");
        }
    }
}
