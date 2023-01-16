<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $size = 2000;
        $faker = Faker::create();

        for ($i = 0; $i <= $size; $i++) {
            $data[] = [
                'title' => $faker->title(),
                'description' =>  $faker->text(),
                'price' => rand(300, 1000),
                'discountPercentage' => rand(3.95, 9.85),
                'rating' => rand(1, 100),
                'stock' => rand(1, 50),
                'brand' => $faker->word(),
                'image' => $faker->imageUrl(640, 480, 'products', true),
                'category_id' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $chunksData = array_chunk($data, $size);
        foreach ($chunksData as $chunk) {
            Product::insert($chunk);
        };
    }
}
