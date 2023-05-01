@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                @include('layouts.header')
                <div class="card-body">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="layui-form" id="login-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-dark">
                                    <div class="card-header text-black  border  border-dark text-left" style="background-color: #BDD7EE; font-size: smaller;" >
                                        <h5 class="font-bold  mb-0">利用者登録</h5>
                                    </div>
                                    <div class="card-body"  style="padding-bottom: 4rem;">
                                        <div class="form-group row" style="padding-top: 2rem;">
                                            <label for="email" class="col-sm-4 col-form-label">ログインID：</label>
                                            <div class="col-sm-8">
                                                <input id="user_id"  name="user_id" value="{{old('user_code', session('user_code', Cookie::get('user_code')))}}" required autofocus
                                                       class="form-control" placeholder="请输入用户名">
                                            </div>
                                        </div>
                                        <div class="form-group row mt-3"  style="padding-top: 4rem;">
                                            <label for="password" class="col-sm-4 col-form-label">パスワード：</label>
                                            <div class="col-sm-8">
                                                <input id="password" type="password" name="password" required
                                                       class="form-control" value="" placeholder="请输入密码">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-4">
                                            <button id="login-button" type="submit" class="btn btn-lg" style="background-color: #BDD7EE; color: white; border: 2px solid #BDD7EE;">
                                                {{ __('ログイン') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0">
                                    <div class="card-header text-black  border  border-dark text-left" style="background-color: #BDD7EE;  font-size: smaller;" >
                                        <h5 class="font-bold mb-0">応用機能</h5>
                                    </div>
                                    <div class="card-body"  style="padding-bottom: 10rem;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul>
                                                    <li>●受注管理</li>
                                                    <li>●見積作成</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul>
                                                    <li>●外注管理</li>
                                                    <li>●作業催促</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul>
                                                    <li>●請求作成</li>
                                                    <li>●各書類作成</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header text-black  border border-dark text-left" style="background-color: #BDD7EE;  font-size: smaller;margin-top: -150px;">
                                        <h5 class="font-bold mb-0">マスタ管理機能</h5>
                                    </div>
                                    <div class="card-body"  style="padding-bottom: 10rem;">
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-md-12">
                                                <ul>
                                                    <li>●取引先情報管理</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12">
                                                <ul>
                                                    <li>●社員情報管理</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: 10px;">
                                            <div class="col-md-5">
                                                <ul>
                                                    <li>・基本情報</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <ul>
                                                    <li>・履歴</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul>
                                                    <li>・経歴</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header text-black  border border-dark text-left" style="background-color: #BDD7EE;font-size: smaller;margin-top: -150px">
                                        <h5 class="font-bold mb-0">開発関連</h5>
                                    </div>
                                    <div class="card-body"  style="padding-bottom: 10rem;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    <li>バージョンVer0.0.0.1</li>
                                                    <li>保留</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{asset('static/plugins/layui/layui.js')}}"></script>
<script>
    layui.use(['layer', 'form'], function() {
        var $ =layui.jquery;
        var layer = layui.layer;
        $('#login-button').click(function (){
            if (!$("#user_id").val()) {
                layer.msg('请输入用户名');
                return false;
            } else {
                var userId = $("#user_id").val();
                var pattern = /^[a-zA-Z0-9_-]{8,20}$/; // 匹配 8-20 个字符，允许的字符包括 a-z、A-Z、0-9、_ 和 -

                if (!pattern.test(userId)) {
                    layer.msg('用户名必须为 8-20 个字符，且仅包含字母、数字、下划线和破折号');
                    return false;
                }
            }
            if(!$("#password").val()){
                layer.msg('请输入密码');
                return false;
            }else{
                var password = $("#password").val();
                var pass_pattern = /^[a-zA-Z0-9]{6,15}$/; // 匹配 8-20 个字符，允许的字符包括 a-z、A-Z、0-9、_ 和 -

                if (!pass_pattern.test(password)) {
                    layer.msg('密码必须为 6-15 个字符，且仅包含字母、数字、下划线和破折号');
                    return false;
                }
            }
            $("#login-button").attr('disabled', true).text('ログイン中...');
            var loadIndex = layer.load(2, {shade: [0.2,'#000']});
            $.ajax({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: "{{route('admin.login')}}",
                data: $("#login-form").serialize(),
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        layer.msg('登录成功',{icon: 1,shade: [0.5, '#393D49'],time:1500},function () {
                            window.location.href = "{{route('admin.index')}}";
                        });
                    } else {
                        layer.msg(res.msg,{shade: [0.5, '#393D49'],time:1500},function () {
                            $("#login-button").text('ログイン').removeAttr('disabled');
                        });
                    }
                },
                complete:function(){
                    layer.close(loadIndex);
                },
                error: function () {
                    layer.msg('网络请求失败',{shade: [0.5, '#393D49'],time:1500},function () {
                        $("#login-button").text('ログイン').removeAttr('disabled');
                    });
                }






            })

        })
    });
</script>

</html>



