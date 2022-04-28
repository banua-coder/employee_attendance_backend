<?php

namespace Database\Seeders;

use App\Models\ContactType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('ContactTypeSeeder')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $contactTypes = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);
            $contactTypes[] = $row;
        }

        $idColumns = ['id'];

        ContactType::upsert(
            $contactTypes,
            $idColumns,
            \array_diff($keys, $idColumns),
        );
    }
}
