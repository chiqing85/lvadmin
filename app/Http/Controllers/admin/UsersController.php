<?php

namespace App\Http\Controllers\admin;

use App\logic\GroupLogic;
use App\logic\UsersLogic;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    protected $rule = array(
        'username' => 'required|min:2|max:20',
        'password' => 'required|min:6',
    );
    /**
     * @title 用户列表
     * @return View
     */
    public function index() {
        $user =  UsersLogic::userlist();
        return view('admin.users.index', compact('user'));
    }

    /**
     * @title 添加用户
     * @return View
     */
    public function create( Request $request ) {
        if(request()->isMethod('get')) {
            $group = GroupLogic::get();
            return view('admin.users.create', compact('group'));
        } else {
            $this->validate($request, $this->rule );
            return UsersLogic::create( $request );
        }
    }

    public function update(User $Users) {
        if(request()->isMethod('get')) {
            $group = GroupLogic::get();
            $Users->load('group');
           return view('admin.users.update', compact(['Users', 'group']));
        } else {
            $this->validate( request( ), [
                'username' => 'required|min:2|max:20'
            ]);
            return UsersLogic::up( $Users );
        }

    }
    /**
     * @title 删除用户
     * @param User $Users
     * @return \App\logic\RedirectResponse
     */
    public function delete(User $Users) {
        return UsersLogic::deletel( $Users );
    }
}
