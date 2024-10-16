<?php

namespace Database\Factories;

use App\Models\Orderline;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderlineFactory extends Factory
{
    protected $model = Orderline::class;

    public function definition(): array
    {
        return [
            'order_id' => $this->faker->randomNumber(),
            'artist' => $this->faker->word(),
            'title' => $this->faker->word(),
            'mb_id' => $this->faker->word(),
            'total_price' => $this->faker->randomFloat(),
            'quantity' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
