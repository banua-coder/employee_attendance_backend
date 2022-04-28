<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('ProvinceSeeder')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            Province::factory(34)->create();

            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $provinces = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $provinces[] = $row;
        }

        $idColumns = ['id'];

        Province::upsert(
            $provinces,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
