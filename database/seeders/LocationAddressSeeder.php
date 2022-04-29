<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\LocationAddress;
use Illuminate\Database\Seeder;

class LocationAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = Str::plural(Str::replace('_seeder', '', Str::snake('LocationAddress')));

        if (! \file_exists(database_path("csvs/$filename.csv"))) {
            // factory
            return;
        }

        $file = file(\database_path("csvs/$filename.csv"));
        $data = array_map('str_getcsv', $file);
        $keys = $data[0];
        array_shift($data);
        $locationAddresses = [];
        foreach ($data as $row) {
            $row = \array_combine($keys, $row);

            if ($row['latitude'] === '') {
                $row['latitude'] = null;
            }

            if ($row['longitude'] === '') {
                $row['longitude'] = null;
            }

            if ($row['address'] === '') {
                $row['address'] = null;
            }

            $locationAddresses[] = $row;
        }

        $idColumns = ['id'];

        LocationAddress::upsert(
            $locationAddresses,
            $idColumns,
            array_diff($keys, $idColumns)
        );
    }
}
