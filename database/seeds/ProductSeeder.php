<?php

use Faker\Factory as Faker;
use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 100; $i++){
            Product::create([
                'name' => 'Produk' . $i,
                'price' => $faker->randomElement($array = array(100000, 200000, 300000)),
                'stock' => $faker->randomElement($array = array(10, 20, 30)),
                'description' => '<p>Test</p>',
                'category' => $faker->randomElement($array = array(1,2,3)),
            ]);
        }
    }
}
