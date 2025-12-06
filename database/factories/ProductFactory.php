<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true), // 假商品名稱
            'description' => $this->faker->sentence(), // 假描述
            'price' => $this->faker->numberBetween(1000, 5000), // 假價格
            'stock' => $this->faker->numberBetween(0, 100), // 假庫存
            'image_url' => $this->faker->imageUrl(400, 300, 'shoes'), // 假圖片
        ];
    }
}
