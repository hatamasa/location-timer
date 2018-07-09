<?php

namespace App\Http\Controllers;

class HelloController extends Controller
{
    public function index()
    {
        $data =  [
            ['id' => 1, 'title' => 'リーダブルコード'],
            ['id' => 2, 'title' => 'プリンシプル オブ プログラミング'],
            ['id' => 3, 'title' => 'リファクタリング(新装版)'],
            ['id' => 4, 'title' => '情熱プログラマー'],
        ];

        return view('hello/hello', ['data' => $data]);
    }
}
