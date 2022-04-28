<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('VillageSeeder')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            // Village::factory(13)->create();
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $villages = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $villages[] = $row;
        }

        $idColumns = ['id'];

        Village::upsert(
            $villages,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
