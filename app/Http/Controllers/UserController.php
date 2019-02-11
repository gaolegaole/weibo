<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UserController extends Controller
{
    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        //dump($user);die;
        return view('users.show',compact('user'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|max:50',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        //注册成功后自动登录
        Auth::login($user);
        //用戶註冊成功後的信息
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show',[$user]);
        //相當於redirect()->route('users.show', [$user->id]);
    }

}
