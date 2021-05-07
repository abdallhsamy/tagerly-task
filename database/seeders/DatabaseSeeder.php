<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {

            Product::factory()
                ->count(random_int(10, 100))
                ->for(Vendor::factory()->create())
                ->has(Vote::factory()->count(random_int(10, 100)))
                ->create();
        }
    }
}
