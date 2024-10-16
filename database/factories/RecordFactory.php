<?php

namespace Database\Factories;

use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RecordFactory extends Factory
{
    protected $model = Record::class;

    public function definition(): array
    {
        return [
            'genre_id' => $this->faker->randomNumber(),
            'artist' => $this->faker->word(),
            'title' => $this->faker->word(),
            'mb_id' => $this->faker->word(),
            'price' => $this->faker->randomFloat(),
            'stock' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
