@extends('layouts._login')
@section('content')
    <div class="container">
        <form class="form-signin" action="">
            <h2 class="form-signin-heading">忘记密码</h2>
            <div class="login-wrap">
                @csrf
                <input type="text" class="form-control" placeholder="注册邮箱" name="email" autofocus>
                <input type="text" class="form-control hidden" placeholder="验证码" name="vscode" autofocus>
                <a class="btn btn-lg btn-login btn-block" type="submit" id="sendEmail">发送邮件</a>
                <a class="btn btn-lg btn-login btn-block hidden" type="submit" id="reset">重置密码</a>
                <a class="btn btn-lg btn-login btn-block" href="logins">返回</a>
            </div>
        </form>
    </div>
@endsection