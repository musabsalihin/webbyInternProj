<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    //
    // public function view(){
    //     $key_list = Redis:
    // }
    public function show(Request $request){
        $content = Redis::get($request['key']);
        $data = [
            'key' => $request['key'],
            'content' =>$content,
        ];

        return view('redis.show', ['data' => $data]);
    }
    public function search(){
        return view('redis.search');
    }

    public function addForm(){
        return view('redis.form');
    }

    public function add(Request $request){
        Redis::set($request->key, $request->content);

        return redirect(route('redis.form'));
    }
}
