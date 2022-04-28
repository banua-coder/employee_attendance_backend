<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\AttendanceType;
use Illuminate\Database\Seeder;

class AttendanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('AttendanceTypeSeeder')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $attendanceTypes = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $attendanceTypes[] = $row;
        }

        $idColumns = ['id'];

        AttendanceType::upsert(
            $attendanceTypes,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
