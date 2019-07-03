<?php

namespace App\Http\Controllers\home;

use App\Link;
use App\logic\LinkLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{

    public function index()
    {
        $link = LinkLogic::getlist();
        return view('home.link.index', compact('link'));
    }
}
