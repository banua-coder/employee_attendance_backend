<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! \file_exists(database_path('csvs/genders.csv'))) {
            Gender::factory(2)->create();

            return;
        }

        $file = file(\database_path('csvs/genders.csv'));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $genders = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $genders[] = $row;
        }

        $idColumns = ['id'];

        Gender::upsert($genders, $idColumns, \array_diff($keys, $idColumns));
    }
}
