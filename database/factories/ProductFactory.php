<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(10, 100),
            'vendor_id' => Vendor::inRandomOrder()->first()->id,
            'sold_times' => $this->faker->numberBetween(10, 100),
            'currency' => $this->faker->currencyCode
        ];
    }
}
