<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class OutstationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('OutstationTypeSeeder')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $outstationTypes = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $outstationTypes[] = $row;
        }

        $idColumns = ['id'];

        \App\Models\OutstationType::upsert(
            $outstationTypes,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
