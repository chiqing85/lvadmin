<?php

namespace App\logic;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UsersLogic extends Model
{
    /**
     * @title 管理员列表
     * @return mixed
     */
    static function userlist() {
        return Cache::rememberForever('userlist', function () {
            return User::orderBy('id')
                ->with('group:id,title')
                ->get(['id', 'username', 'pic', 'created_at', 'status']);
        });
    }

    /**
     * @title 添加用户
     * @param $callback
     * @return Redirector
     */
    static function create( $callback ) {
        $data = $callback->all();
        $data['password'] = bcrypt( $data['password'] );
        $data['status'] = $data['status'] ? $data['status'] : '0';
        $data['pic'] = $data['pic'] ? $data['pic'] : '/static/admin/images/a5.jpg';
        $data['group'] = empty($data['group']) ? null : $data['group'];
        $User = User::create( $data );
        $User->group()->attach( $data['group'] );
        Cache::forget('userlist');
        return redirect('/admin/users');
    }

    /**
     * @title 编辑用户信息
     * @param $callback
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    static function up( $callback ) {
        $data = request(['status', 'username', 'email', 'pic', 'group']);
        $data['group'] = empty($data['group']) ? null : $data['group'];
        $callback->group()->detach( );
        $callback->group()->attach( $data['group'] );
         /*
          foreach ( $data['group'] as $v ) {
             $callback->group()->updateExistingPivot($callback['id'], array( 'group_id' => $v ));   //更新中间表
         }
         */

        $callback->update( $data );
        Cache::forget('userlist');
        return redirect( '/admin/users' );
    }

    /**
     * @title 删除用户
     * @param $callback
     * @return RedirectResponse
     */
    static function deletel( $callback ) {
        $pic = public_path( $callback->pic);
        $path = substr($pic,0,strrpos($pic,"/"));
        $callback->delete();
        $callback->group()->detach( );
        $re = unlink( $pic );   //删除用户头像
        if( is_dir( $path ) ) rmdir( $path );  // 删除目录
        Cache::forget('userlist');
        return back();
    }
}
