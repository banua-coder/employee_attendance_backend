<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GenderSeeder::class,
            ReligionSeeder::class,
            ProvinceSeeder::class,
            RegencySeeder::class,
            DistrictSeeder::class,
            VillageSeeder::class,
            ContactTypeSeeder::class,
            ApprovalStatusSeeder::class,
            AttendanceStatusSeeder::class,
            AttendanceTypeSeeder::class,
            EducationSeeder::class,
            EchelonSeeder::class,
            GradeSeeder::class,
            WorkSchemeSeeder::class,
            ShiftSeeder::class,
            OutstationTypeSeeder::class,
            OutstationStatusSeeder::class,
            LeaveTypeSeeder::class,
            DepartmentSeeder::class,
            HolidaySeeder::class,
            OfficeSeeder::class,
            LocationAddressSeeder::class,
            EmploynmentStatusSeeder::class,
            UserSeeder::class,
            UserGradeSeeder::class,
        ]);
    }
}
