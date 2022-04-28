<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('ReligionSeeder')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            Religion::factory(7)->create();

            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $religions = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $religions[] = $row;
        }

        $idColumns = ['id'];

        Religion::upsert(
            $religions,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
