<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    //登录页面
    public function login()
    {
        return view('admin.index.login');
    }

    public function handle(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->only(['email', 'password']);
            if (Auth::attempt($data)) {
                return json_encode([
                    'code' => 200,
                    'msg' => '登录成功',
                    'url' => 'homes'
                ]);
            } else {
                return json_encode([
                    'code' => 400,
                    'msg' => '邮箱或密码错误'
                ]);
            }
        }
    }

    //管理员注册
    public function added(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->only(['email', 'password', 'cofirmpassword', 'name']);
            $response = (new \App\Models\User())->register($data);
            if ($response == '200') {
                return json_encode(['code' => '200', 'msg' => '注册成功']);
            } else {
                return json_encode(['code' => '400', 'msg' => $response]);
            }
        }
        return view('admin.index.added');
    }

    //忘记密码
    public function forget(Request $request)
    {
        if ($request->isMethod('post')) {
            $email = $request->only('email');
            $response = (new \App\Models\User())->forget($email);
            if ($response == '200') {
                return json_encode(['code' => '200', 'msg' => '邮件发送成功']);
            } else {
                return json_encode(['code' => '400', 'msg' => $response]);
            }
        }
        return view('admin.index.forget');
    }

    //重置密码
    public function reset(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->only(['vscode', 'email']);
            if ($data['vscode'] != session('vscode')) {
                return json_encode([
                    'code'=>'400',
                    'msg'=>'验证码不正确'
                ]);
            }
            $response = (new \App\Models\User())->reset($data);
            if($response == '200'){
                $msg = [
                  'code'=>'200',
                  'msg'=>'密码重置成功,请去邮箱查看!'
                ];
            }else{
                $msg = [
                    'code'=>'400',
                    'msg'=>'密码重置失败!'
                ];
            }
            return json_encode($msg);
        }
    }
}
