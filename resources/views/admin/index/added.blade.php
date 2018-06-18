@extends('layouts._login')
@section('content')
    <div class="container">
        <form class="form-signin" action="">
            <h2 class="form-signin-heading">用户注册</h2>
            <div class="login-wrap">
                @csrf
                <input type="text" class="form-control" placeholder="邮箱" name="email" autofocus>
                <input type="text" class="form-control" name="name" placeholder="用户名">
                <input type="password" class="form-control" name="password" placeholder="密码">
                <input type="password" class="form-control" name="cofirmpassword" placeholder="确认密码">
                <a class="btn btn-lg btn-login btn-block" type="submit" id="added">注册</a>
                <a class="btn btn-lg btn-login btn-block" href="logins">返回</a>
            </div>
        </form>
    </div>
@endsection
