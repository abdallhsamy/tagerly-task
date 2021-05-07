<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    protected $model = Vote::class;

    public function definition()
    {
        return [
            'rate' => $this->faker->numberBetween(1, 5),
            'review' => $this->faker->text,
            'product_id' => Product::inRandomOrder()->first()->id,
            'user' => $this->faker->name,
        ];
    }
}
