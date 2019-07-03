<?php

namespace App\Http\Controllers\admin;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    protected $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @title 个人中心
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function infop()
    {
        $user = \Auth::user();
        return view('admin.account.infop', compact('user'));
    }

    /**
     * @title 更新个人信息
     * @return int
     */
    public function update()
    {
        $data = \request()->all();
        $code = DB::table('users')
            ->where('id', \Auth::user()->id )
            ->update([ \request('name') => \request('value')]);
        return $code;
    }

    public function pwd()
    {
        return view('admin.account.pwd');
    }

    /**
     * @title 更新密码
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function uppwd()
    {
        if( $this->validateCredentials( \request('ipas') ) ) {
            if( \request('password') === \request('passwords'))
            {
                DB::table('users')
                    ->where('id', \Auth::user()->id )
                    ->update(['password' => bcrypt( \request('password') )]);

                return redirect('/admin/account/infop');
            } else {
                return redirect()->back()->withErrors('二次输入的密码不一致…');
            }
        } else {
            return redirect()->back()->withErrors('原始密码错误…');
        }

    }

    public function validateCredentials( $ipas) {

        return $this->hasher->check( $ipas, \Auth::user()->password );
    }

}
