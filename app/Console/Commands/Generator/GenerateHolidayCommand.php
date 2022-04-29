<?php

namespace App\Console\Commands\Generator;

use Exception;
use App\Models\Holiday;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class GenerateHolidayCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holiday:generate {--is-seeder : Check if command run from seeder} {--year= : Year of holiday to generate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate holidays for a specific year in a country';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $isSeeder = $this->option('is-seeder');

        if ($isSeeder) {
            $year = Carbon::now()->year;
        } else {
            $year = (int) $this->ask(
                'Holidays for what year do you want to generate?: ',
                $this->option('year'),
            );
        }

        if (is_null($year)) {
            $this->error('Year can`t be null!');

            return Command::FAILURE;
        }

        if ($isSeeder) {
            $country = config('app.locale');
        } else {
            $country = $this->ask(
                'Insert two character country code: ',
                'ID',
            );
        }

        if (is_null($country)) {
            $this->error('Invalid country code!');

            return Command::FAILURE;
        }

        $validator = Validator::make(
            [
                'year' => $year,
            ],
            [
                'year' => ['numeric', 'integer', 'max:'.now()->year],
            ]
        );

        if ($validator->fails()) {
            $this->error('Year must be less than or equal to '.now()->year.'!');

            return Command::FAILURE;
        }

        $validator = Validator::make(
            [
                'code' => $country,
            ],
            [
                'code' => ['string', 'max:2', 'min:2'],
            ]
        );

        if ($validator->fails()) {
            $this->error('Invalid country code!');

            return Command::FAILURE;
        }

        $this->generateHolidays($year, $country);

        $this->info('Holidays for '.$year.' has been generated!');

        return Command::SUCCESS;
    }

    private function generateHolidays($year, $country)
    {
        // $data = Calendarific::make(
        //     config('services.calendarific.api_key'),
        //     $country,
        //     $year,
        //     null,
        //     null,
        //     null,
        //     ['national']
        // );

        $local_data = Http::get('https://api-harilibur.vercel.app/api?year='.$year);

        $data = $local_data->json();

        if (! $data) {
            $this->error('Something went wrong, please try again!');

            return Command::FAILURE;
        }

        $holidays = [];

        try {
            foreach ($data as $holiday) {
                if ($holiday['is_national_holiday']) {
                    $holidays[] = [
                        'name' => $holiday['holiday_name'],
                        'description' => $holiday['holiday_name'],
                        'holiday_date' => Carbon::parse($holiday['holiday_date']),
                    ];
                }
            }

            Holiday::upsert($holidays, ['holiday_date'], ['name', 'description']);
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }
    }
}
