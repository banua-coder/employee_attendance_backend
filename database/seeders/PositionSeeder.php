<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('PositionSeeder')));

        if (!\file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $positions = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $positions[] = $row;
        }


        $idColumns = ['id'];

        \App\Models\Position::upsert(
            $positions,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
