<?php

use Illuminate\Database\Seeder;
use App\Entities\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();
        
        Setting::insert([
            ['id' => 1, 'name' => Setting::REPORT_DEADLINE, 'value' => 10, 'description' => 'День місяця, до якого виконавці повинні здати звіт'],
        ]);        
    }
}
