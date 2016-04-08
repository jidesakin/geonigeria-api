<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redis;

class StateController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showArticle ( $id )
    {
        $storage = Redis::Connection();

        $views = $storage->incr('article:' . $id . 'views');

        $storage->zIncrBy('articleViews', 1, 'article:' . $id);

        return "This is an article with id: " . $id . " it has " . $views . " views";
    }
}
