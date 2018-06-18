@extends('layouts._login')
@section('content')
    <div class="container">
        <form class="form-signin" action="">
            <h2 class="form-signin-heading">后台登录</h2>
            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="邮箱" name="email" autofocus>
                <input type="password" class="form-control" name="password" placeholder="密码">
                <input type="hidden" value="{{csrf_token()}}" name="_token">
                <label class="checkbox">
                    <a href="{{route('forget')}}"> 忘记密码</a>
                    <span class="pull-right">
                    <a href="{{route('added')}}"> 没有账号？现在就去注册</a>
                </span>
                </label>
                <a class="btn btn-lg btn-login btn-block" type="submit" id="submit">登录</a>
            </div>
        </form>
    </div>
@endsection
