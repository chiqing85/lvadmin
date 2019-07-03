<?php

namespace App\Http\Controllers\admin;

use App\logic\NoticesLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Pusher\Pusher;

class NoticesController extends Controller
{
    public function index()
    {
        // 分发队列
        // dispatch( new \App\Jobs\SendMessage( $notice );
    }

    public function noticesall()
    {
        return NoticesLogic::wall();
    }

    public function pusher()
    {
        if (\Auth::user()->id )
        {
            $pusher = new Pusher( env("PUSHER_APP_KEY" ), env("PUSHER_APP_SECRET"), env('PUSHER_APP_ID'));
            echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
        } else {
            header('', true, 403);
            echo "Forbidden";
        }
    }



}
