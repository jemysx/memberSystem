<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminLoginService;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    /**
     * 登录
     * @return
     */
    public function login(Request $request)
    {
        if($request->isMethod('POST')){
            return (new AdminLoginService())->login($request->post());
        }else{
            return view('public.login');
        }
    }

}
