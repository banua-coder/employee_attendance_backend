<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('DistrictSeeder')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            District::factory(13)->create();

            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $districts = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $districts[] = $row;
        }

        $idColumns = ['id'];

        District::upsert(
            $districts,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
