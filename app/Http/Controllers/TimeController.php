<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeController extends Controller
{
    // TODO timezoneはindexでDBから取得
    private $timezone_list = [
        'Asia/Tokyo', 'Europe/Paris', 'Europe/Rome', 'America/New_York'
    ];

    public function index()
    {
        foreach ($this->timezone_list as $timezone) {
            date_default_timezone_set($timezone);
            $times[] = ['name' => date_default_timezone_get(), 'time' => date('Y/m/d D  H:i:s')];
        }

        return view('time/index', ['times' => $times]);
    }

    // TODO 会議プロジェクト&メンバー入力、保存ボタン（cookieから取得&保存）
    // TODO メールテンプレートを作成するボタン
}
