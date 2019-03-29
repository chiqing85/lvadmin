<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\User;

class IndexController extends Controller
{
    public function index() {

        return view('admin.index.index');
    }
}
