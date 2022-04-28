<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('EducationSeeder')));

        if (!\file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }


        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $educations = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $educations[] = $row;
        }

        $idColumns = ['id'];

        Education::upsert(
            $educations,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
