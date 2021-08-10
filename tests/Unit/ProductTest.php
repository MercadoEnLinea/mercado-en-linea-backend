<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create()
    {

        $data = [
            'seller_id' => 1,
            'name' => 'Unit Testing Product',
            'description' => 'Unit Testing Products',
            'category_id' => 1,
            'delivery_options' => ['PERSONAL', 'MAIL'],
            'payment_options' => ['CASH'],
            'images' => ['https://carlosgomez.mx/assets/front/img/avatar_1624175972505033680.png']

            ];
        $product = Product::create($data);
        $product->delivery_options = ['PERSONAL', 'MAIL'];
        $product->payment_options = ['CASH'];
        $product->save();


        $this->assertDatabaseHas('products',[
            'id'=> $product->id,
            'seller_id' => 1,
            'name' => 'Unit Testing Product',
            'description' => 'Unit Testing Products',
            'category_id' => 1,
            'delivery_options' => json_encode(['PERSONAL', 'MAIL']),
            'payment_options' => json_encode(['CASH'])

        ]);
    }
}
