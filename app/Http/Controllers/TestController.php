<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        $data =  [
            ['id' => 1, 'title' => 'リーダブルコード'],
            ['id' => 2, 'title' => 'プリンシプル オブ プログラミング'],
            ['id' => 3, 'title' => 'リファクタリング(新装版)'],
            ['id' => 4, 'title' => '情熱プログラマー'],
        ];

        return view('test/test', ['data' => $data]);
    }
}
