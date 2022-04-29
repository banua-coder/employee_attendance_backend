<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Holiday::whereYear('holiday_date', date('Y'))->count() > 0) {
            return;
        }

        Artisan::call('holiday:generate', ['--is-seeder' => true]);
    }
}
