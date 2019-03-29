<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index() {
        $user = \App\User::orderBy('created_at', 'desc')
              ->with('group:id,title')
              ->get(['id', 'username', 'pic', 'created_at']);

        return view('admin.users.index', compact('user'));
    }
}
