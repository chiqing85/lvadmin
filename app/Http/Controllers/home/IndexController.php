<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index() {
        $title = '清蝎子';

        return view('home.index.index', compact('title'));
    }
}
