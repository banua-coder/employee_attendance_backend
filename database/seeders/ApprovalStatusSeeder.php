<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\ApprovalStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApprovalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('ApprovalStatusSeeder')));

        if (!\file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $approvalStatuses = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $approvalStatuses[] = $row;
        }

        $idColumns = ['id'];

        ApprovalStatus::upsert(
            $approvalStatuses,
            $idColumns,
            \array_diff($keys, $idColumns)
        );
    }
}
