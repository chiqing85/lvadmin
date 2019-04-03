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
                  ->get();
        return view('admin.aclass.index', compact('aclass'));
    }

    public function create(Request $request) {
        if( $request->isMethod('get') ) {
            return view('admin.aclass.create');
        } else {
            $this->validate($request, [
                'mid' => 'required|numeric',
                'name' => 'required',
                'dirs' => 'required'
            ]);
            $data = request(['mid', 'name', 'dirs', 'sort', 'status']);
            Aclass::create($data);
            return back();
        }
    }
}