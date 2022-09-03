<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{

    protected $model = ProductImage::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'product_id'=>Product::all()->random()->id,
            'pi_sub_image' => 'https://source.unsplash.com/random'
        ];
    }
}
