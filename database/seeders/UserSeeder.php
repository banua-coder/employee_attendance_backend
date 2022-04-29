<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('UserSeeder')));

        if (!\file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $users = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);

            if ($row['religion_id'] === '') {
                $row['religion_id'] = null;
            }

            if ($row['email'] === '') {
                $row['email'] = null;
            }

            if ($row['username'] === '') {
                $row['username'] = null;
            }

            if ($row['date_of_birth'] === '') {
                $row['date_of_birth'] = null;
            }

            $row['password'] = Hash::make($row['id_card_number']);

            $users[] = $row;
        }

        $idColumns = ['id'];

        \App\Models\User::upsert(
            $users,
            $idColumns,
            array_diff($keys, $idColumns)
        );
    }
}
