<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //注册
    public function register($data){
        $rule = [
            'email'=>'required|unique:users',
            'name'=>'required|min:4',
            'password'=>'required|min:6',
            'cofirmpassword'=>'required|same:password|min:6',
        ];
        $msg = [
            'email.required'=>'邮箱不能为空',
            'email.unique'=>'邮箱已经存在'

        ];
        $validator = Validator::make($data,$rule,$msg);
        if($validator->fails()){
            return $validator->errors()->first();
        }
        $result = self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        if($result){
            return 200;
        }else{
            return '注册失败';
        }
    }
}
