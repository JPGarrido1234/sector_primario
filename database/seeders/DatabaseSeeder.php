<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FruitVegetable;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        FruitVegetable::factory(20)->create();
    }
}
