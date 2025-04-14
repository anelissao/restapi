<?php

namespace Database\Factories;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->country(),
            'capital' => $this->faker->city(),
            'population' => $this->faker->numberBetween(1000000, 500000000),
            'region' => $this->faker->randomElement(['Europe', 'Asia', 'Africa', 'Americas', 'Oceania']),
            'subregion' => $this->faker->randomElement(['Western Europe', 'Eastern Europe', 'Southeast Asia', 'North America', 'South America']),
            'flag_url' => null,
            'currency' => $this->faker->currencyCode(),
            'language' => $this->faker->locale(),
            'motto' => $this->faker->optional()->sentence(3),
        ];
    }
}