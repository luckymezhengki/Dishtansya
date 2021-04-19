<?php

use Illuminate\Database\Seeder;
use App\Product;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1, 10) as $index)  {
            Product::create([
                'name' => $faker->city,
                'available_stock' => $faker->numberBetween($min = 0, $max = 9999)
            ]);
        }
    }
}
