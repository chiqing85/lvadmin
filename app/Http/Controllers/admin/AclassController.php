<?php

namespace App\Http\Controllers\admin;

use App\Aclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AclassController extends Controller
{
    protected $val = array(
        'mid' => 'required|numeric',
        'name' => 'required',
        'pid' => 'required'
    );
    /**
     * @title 分类列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $aclass = \App\Aclass::orderBy('sort', 'desc')
                  ->get(['id', 'name', 'dirs', 'mid','sort','pid', 'status']);

        $aclass = create($aclass);
        //  无限分类是否有子类
        foreach ($aclass as $k => $v) {
            foreach ($aclass as $s)
                if($v['id'] == $s['pid']) {
                    $v['h_layer'] = 1;
                    break;
                } else {
                    $v['h_layer'] = 0;
                }
        }
        return view('admin.aclass.index', compact('aclass'));
    }

    /**
     * @title 添加文章分类
     * @param Request $request
     * @return View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request) {

        if( $request->isMethod('get') ) {
            $pid = request('id') ? request('id') : 0;
            return view('admin.aclass.create', compact('pid'));
        } else {
            $this->validate($request, $this->val );
            $data = request(['mid', 'name', 'dirs', 'sort', 'status', 'pid']);
            Aclass::create($data);
            return back();
        }
    }

    public function update(Aclass $aclass) {
        if(request()->isMethod('get')) {
            return view('admin.aclass.update', compact('aclass'));
        } else {
            $this->validate(request(), $this->val);
            $data = request(['mid', 'name', 'dirs', 'sort', 'status', 'pid']);
            $data['status'] = request('status') ? request('status') : 0;
            $aclass->update($data);
            return redirect('/admin/aclass');
        }
    }

    /**
     * @title 删除分类
     * @param Aclass $Aclass
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Aclass $Aclass ) {
        $Aclass->delete();
        return back();
    }

}