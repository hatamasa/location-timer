<?php

use App\Time;
use Illuminate\Database\Seeder;

class TimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10;$i++) {
            $time = new Time();
            $time->country_name = 'COUNTRY' . $i;
            $time->utc_diff = $i;
            $time->timezone = 'COUNTRY/' . $i;
            $time->save();
        }
    }
}
