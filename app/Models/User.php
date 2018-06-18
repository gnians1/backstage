<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
class User extends Model
{
  protected  $table = 'users';

    protected $fillable = [
        'name', 'email', 'password','is_admin','status'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    //注册逻辑
    public function register($data){
        $rule = [
          'email'=>'required|unique:users',
          'name'=>'required|min:4',
          'password'=>'required|min:6',
          'cofirmpassword'=>'required|same:password|min:6',
        ];
        $msg = [
            'email.required'=>'邮箱不能为空',
            'email.unique'=>'邮箱已经存在',
            'name.required'=>'用户名不能为空',
            'name.min'=>'用户名长度最少4个字符',
            'password.required'=>'密码不能为空',
            'password.required'=>'密码长度最少6个字符',
            'cofirmpassword.required'=>'确认密码不能为空',
            'cofirmpassword.same'=>'2次输入密码不一致',
        ];
        $validator = Validator::make($data,$rule,$msg);
        if($validator->fails()){
            return $validator->errors()->first();
        }
        $result = self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'is_admin'=>rand(0,1),
            'status'=>0
        ]);
        if($result){
            return 200;
        }else{
            return '注册失败';
        }
    }

    //忘记密码发送邮件
    public function forget($email){
        $result = $this->where('email',$email)->first();
        if(!$result){
            return '邮箱不存在';
        }else{
            $content =mt_rand(1000,9999);
            session(['vscode'=>$content]);
            $sendMsg = sendmail($result['email'],'获取验证码',$content);
            if($sendMsg){
                return "200";
            }else{
                return "邮件发送失败";
            }
        }
    }

    //重置密码
    public function reset($data){
        $result = $this->where('email',$data['email'])->first();
        if($result->toArray()){
            $newPassword = mt_rand(1000,9999);
            $result['password'] = bcrypt($newPassword);
            $returnInfo = $result->save();
            if($returnInfo){
                $content = '用户名'.$data['email'].'新密码'.$newPassword;
                sendmail($data['email'],'恭喜你，密码重置成功',$content);
                return '200';
            }else{
                return '密码重置失败!';
            }
        }else{
            return '密码重置失败!';
        }
    }
}
