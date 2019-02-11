<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
class SessionController extends Controller
{
    /*
    login
    */
    public function create(){
        return view('sessions.create');
    }
    /*login*/
    public function store(Request $request){
        $credentials = $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required'
        ]);
        //Auth::attempt()接受一个数组，来进行登录，返回true或false
        if(Auth::attempt($credentials)){
            //认证通过
            session()->flash('success','欢迎回来！');
            //Laravel 提供的 Auth::user() 方法来获取 当前登录用户 的信息
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            //未通过
            //使用 withInput() 后模板里old('email') 将能获取到上一次用户提交的内容，这样用户就无需再次输入邮箱等内容：
            session()->flash('danger','您的邮箱和密码不匹配！');
            return redirect()->back()->withInput();
        }
    }
    /*
    logout
    */
    public function destroy(){

    }
}