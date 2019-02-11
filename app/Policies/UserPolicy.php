<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //让我们为默认生成的用户授权策略添加 update 方法，用于用户更新时的权限验证。
    public function udpate(User $currentUser,User $user){
        //1. 我们并不需要检查 $currentUser 是不是 NULL。未登录用户，框架会自动为其 所有权限 返回false ；
        //2. 调用时，默认情况下，我们 不需要 传递当前登录用户至该方法内，因为框架会自动加载当前登录用户（接着看下去，后面有例子）；
        return $currentUser->id === $user->id;
    }

    public function destroy(User $currentUser ,User $user){
        //必须是管理员，并且不能删除自己
        //return true;
        return $currentUser->ia_admin && $currentUser->id !== $user->id;
    }
}
