<?php

namespace Database\Seeders;

use App\Models\Echelon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class EchelonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('EchelonSeeder')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $echelons = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $echelons[] = $row;
        }

        $idColumns = ['id'];

        Echelon::upsert(
            $echelons,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
