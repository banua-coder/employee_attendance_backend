<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('DepartmentSeeder')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $departments = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $departments[] = $row;
        }

        $idColumns = ['id'];

        \App\Models\Department::upsert(
            $departments,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
