<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'United States of America',
            'code' => '1',
            'symbol' => 'US',
            'flag' => 'https://restcountries.eu/data/usa.svg'
        ]);

        Country::create([
            'name' => 'Japan',
            'code' => '81',
            'symbol' => 'JP',
            'flag' => 'https://restcountries.eu/data/jpn.svg'
        ]);

        Country::create([
            'name' => 'Italy',
            'code' => '39',
            'symbol' => 'IT',
            'flag' => 'https://restcountries.eu/data/ita.svg'
        ]);

        Country::create([
            'name' => 'Thailand',
            'code' => '66',
            'symbol' => 'TH',
            'flag' => 'https://restcountries.eu/data/tha.svg'
        ]);

        Country::create([
            'name' => 'Hong Kong',
            'code' => '852',
            'symbol' => 'HK',
            'flag' => 'https://restcountries.eu/data/hkg.svg'
        ]);

        Country::create([
            'name' => 'Nigeria',
            'code' => '234',
            'symbol' => 'NG',
            'flag' => 'https://restcountries.eu/data/nga.svg'
        ]);

        Country::create([
            'name' => 'Canada',
            'code' => '1',
            'symbol' => 'CA',
            'flag' => 'https://restcountries.eu/data/can.svg'
        ]);

        Country::create([
            'name' => 'Germany',
            'code' => '49',
            'symbol' => 'DE',
            'flag' => 'https://restcountries.eu/data/deu.svg'
        ]);

        Country::create([
            'name' => 'Indonesia',
            'code' => '62',
            'symbol' => 'ID',
            'flag' => 'https://restcountries.eu/data/idn.svg'
        ]);

        Country::create([
            'name' => 'Singapore',
            'code' => '65',
            'symbol' => 'SG',
            'flag' => 'https://restcountries.eu/data/sgp.svg'
        ]);

        Country::create([
            'name' => 'Philippines',
            'code' => '63',
            'symbol' => 'PH',
            'flag' => 'https://restcountries.eu/data/phl.svg'
        ]);

    }
}
