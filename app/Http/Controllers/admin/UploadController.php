<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function index() {

    }

    public function image( Request $request) {

        $path = $request->file('images')
            ->storePublicly( md5( time() ) );

        return '/storage/'. $path;
        //  return asset('storage/'. $path );
    }
}
