<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmploynmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('EmploynmentStatusSeeder')));

        if (!\file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $employnmentStatuses = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $employnmentStatuses[] = $row;
        }

        $idColumns = ['id'];

        \App\Models\EmploynmentStatus::upsert(
            $employnmentStatuses,
            $idColumns,
            array_diff($keys, $idColumns)
        );
    }
}
