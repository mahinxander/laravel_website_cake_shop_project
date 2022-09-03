<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{

    protected $model = OrderProduct::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $product=$this->faker->name;
        return [
            //
            'order_id'=>Order::all()->random()->id,
            'product_id'=>Product::all()->random()->id,
            'quantity'=>$this->faker->numerify('#'),
            'price'=>$this->faker->numerify('####')
        ];
    }
}
