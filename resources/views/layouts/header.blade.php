<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- 添加 Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{asset('static/plugins/layui/css/layui.css')}}" rel="stylesheet"/>
</head>
<div class="card-header" style="background-color: white">
    <div class="row" style="padding-top: 25px">
        <div class="col-md-4">
            <h4 class="text-left" style="font-size: 1.1rem; font-weight: bold;">株式会社ブライトスター</h4>
            <h4 class="text-left" style="font-size: 1.1rem;">BRIGHT STAR CO.LTD.</h4>
        </div>
        <div class="col-md-4 text-center">
            <h4 class="text-center" style="font-size: 1.1rem;">社内統合管理システム</h4>
        </div>
        <div class="col-md-4 text-right">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" width="100" height="50" style="margin-left: 110px">
        </div>
    </div>
</div>
</html>
