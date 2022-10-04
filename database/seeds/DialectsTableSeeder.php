<?php

use Illuminate\Database\Seeder;

class DialectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ethnicities = [
            "Mestizo",
            "Maya",
            "Xinca",
            "Garifona",
        ];

        foreach ($ethnicities as $name) {
            App\TuChance\Models\Ethnicity::firstOrCreate(compact('name'));
        }

        $dialects = [
            ['code' => '01', 'name' => "K'ICHE'"],
            ['code' => '02', 'name' => "KAQCHIKEL"],
            ['code' => '03', 'name' => "TZ'UTUJIL"],
            ['code' => '04', 'name' => "ACHI"],
            ['code' => '05', 'name' => "SAKAPULTEKO"],
            ['code' => '06', 'name' => "IXIL"],
            ['code' => '07', 'name' => "USPANTEKO"],
            ['code' => '08', 'name' => "MAM"],
            ['code' => '09', 'name' => "CHUJ"],
            ['code' => '10', 'name' => "POPTI' (JAKALTEKO)"],
            ['code' => '11', 'name' => "Q'ANJOB'AL"],
            ['code' => '13', 'name' => "AWAKATEKO (IDIOMA ESPAÑOL)"],
            ['code' => '14', 'name' => "Q'EQCHI'"],
            ['code' => '15', 'name' => "POQOMCHI'"],
            ['code' => '17', 'name' => "POQOMAM"],
            ['code' => '18', 'name' => "ITZAJ"],
            ['code' => '19', 'name' => "CH'ORTI'"],
            ['code' => '20', 'name' => "AKATEKO"],
            ['code' => '21', 'name' => "XINKA"],
            ['code' => '22', 'name' => "MOPAN"],
            ['code' => '24', 'name' => "GARIFUNA"],
            ['code' => '25', 'name' => "SIPAKAPENSE"],
            ['code' => '26', 'name' => "TEKTITEKO"],
            ['code' => '28', 'name' => "LADINO / NO INDIGENA"],
            ['code' => '29', 'name' => "CHALCHITEKO"],
        ];

        foreach ($dialects as $row) {
            App\TuChance\Models\Dialect::firstOrCreate($row);
        }
    }
}
