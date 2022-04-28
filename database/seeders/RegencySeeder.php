<?php

namespace Database\Seeders;

use App\Models\Regency;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('RegencySeeder')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            Regency::factory(13)->create();

            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $regencies = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $regencies[] = $row;
        }

        $idColumns = ['id'];

        Regency::upsert(
            $regencies,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
