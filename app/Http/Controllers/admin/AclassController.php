<?php

namespace App\Http\Controllers\admin;

use App\Aclass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AclassController extends Controller
{
    // 分类列表
    public function index() {

        $aclass = \App\Aclass::orderBy('sort', 'desc')
                  ->get(['id', 'name', 'dirs', 'mid','sort','pid', 'status']);

        $aclass = create($aclass);

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
            $this->validate($request, [
                'mid' => 'required|numeric',
                'name' => 'required',
                'pid' => 'required'
            ]);
            $data = request(['mid', 'name', 'dirs', 'sort', 'status', 'pid']);
            Aclass::create($data);
            return back();
        }
    }

    public function update(Aclass $aclass) {
        return view('admin.aclass.update', compact('aclass'));
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