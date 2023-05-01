@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    @include('layouts.header')
                    <div class="card-body">
                        登录信息等
                        <hr>
                        各个菜单显示
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('static/plugins/layui/layui.js')}}"></script>
