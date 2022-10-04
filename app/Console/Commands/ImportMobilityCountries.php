<?php

namespace App\Console\Commands;

use App\TuChance\Models\LaborMobilityCountry;
use Illuminate\Console\Command;

class ImportMobilityCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tuchance:mobility:import:countries {iso*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $isos = $this->argument('iso');

        $countries = $this->laravel['db']
            ->table('countries')
            ->whereIn('code', $isos)
            ->get();

        $countries->each(function ($country) {
            $labor_country = (new LaborMobilityCountry)
                ->where('remote_id', $country->id)
                ->firstOrNew([]);
            $labor_country->remote_id = $country->id;
            $labor_country->name      = $country->name;
            $labor_country->save();
        });
    }
}
