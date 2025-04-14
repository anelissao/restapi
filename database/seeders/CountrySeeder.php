<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            [
                'name' => 'France',
                'capital' => 'Paris',
                'population' => 67391582,
                'region' => 'Europe',
                'subregion' => 'Western Europe',
                'flag_url' => null,
                'currency' => 'Euro',
                'language' => 'French',
                'motto' => 'Liberté, Égalité, Fraternité',
            ],
            [
                'name' => 'Japan',
                'capital' => 'Tokyo',
                'population' => 126476461,
                'region' => 'Asia',
                'subregion' => 'Eastern Asia',
                'flag_url' => null,
                'currency' => 'Japanese yen',
                'language' => 'Japanese',
                'motto' => null,
            ],
            [
                'name' => 'Brazil',
                'capital' => 'Brasília',
                'population' => 212559417,
                'region' => 'Americas',
                'subregion' => 'South America',
                'flag_url' => null,
                'currency' => 'Brazilian real',
                'language' => 'Portuguese',
                'motto' => 'Ordem e Progresso',
            ],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}