<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/error', function (Request $request) {
    $msg = $request->get('msg','发生错误了');
    $code = $request->get('code','400');
    return view('error',['code'=>$code,'msg'=>$msg]);
})->name('error');

