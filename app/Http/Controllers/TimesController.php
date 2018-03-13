<?php

namespace App\Http\Controllers;

use App\Time;
use Illuminate\Http\Request;

class TimesController extends Controller
{
    // TODO timezoneはindexでDBから取得
    private $timezone_list = [
        'Asia/Tokyo', 'Europe/Paris', 'Europe/Rome', 'America/New_York'
    ];

    public function index()
    {
        $times = Time::orderBy('id', 'asc')->get();
        foreach ($times as $time) {
            try{
                date_default_timezone_set($time->timezone);
                $country_times[] = [
                    'id' => $time->id,
                    'country_name' => $time['country_name'],
                    'timezone' => date_default_timezone_get(),
                    'time' => date('Y/m/d D  H:i:s')
                ];
            } catch (\Exception $e) {
                $country_times[] = [
                    'id' => $time->id,
                    'country_name' => $time['country_name'],
                    'timezone' => $time->timezone,
                    'time' => 'invalid timezone...'
                ];
            }
        }

        return view('time.index', ['country_times' => $country_times]);
    }

    // TODO 会議プロジェクト&メンバー入力、保存ボタン（cookieから取得&保存）
    // TODO メールテンプレートを作成するボタン

    public function create()
    {
        return view('time.create');
    }

    public function store(Request $request)
    {
        $time = new Time();
        $time->country_name = $request->country_name;
        $time->utc_diff = $request->utc_diff;
        $time->timezone = $request->timezone;
        $time->save();

        return view('time.store');
    }

    public function edit(Request $request, $id) {
        $time = Time::find($id);
        return view('time.edit', ['time' => $time]);
    }

    public function update(Request $request) {
        $time = Time::find($request->id);
        $time->country_name = $request->country_name;
        $time->utc_diff = $request->utc_diff;
        $time->timezone = $request->timezone;
        $time->save();

        return view('time.update');
    }

    public function show(Request $request, $id) {
        $time = Time::find($id);
        return view('time.show', ['time' => $time]);
    }

    public function delete(Request $request) {
        Time::destroy($request->id);
        return view('time.delete');
    }

}
