<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        $text = 'Hello World!!';

        return view('hello', ['text' => $text]);
    }
}
