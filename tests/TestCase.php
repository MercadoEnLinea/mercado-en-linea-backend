<?php

namespace Tests;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use \Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function setUp(): void
    {



        parent::setUp();


        $buyer = User::updateOrCreate([
            'name' => 'Demo Buyer User',
            'email'=>'demo@demo.com',
            'password' => Hash::make('password'),
            'phone' => '0000000000'
        ]);


        $seller = User::updateOrCreate([
            'name' => 'Demo Seller User',
            'email'=>'demoSeller@demo.com',
            'password' => Hash::make('password'),
            'phone' => '0000000001'
        ]);

        $data = [
            'name' => 'Base Test Category',
            'description' => 'Unit Testing Categories'];
        $category = Category::create($data);


        $data = [
            'seller_id' => 1,
            'name' => 'Unit Base Testing Product',
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



        $data = [
            'seller_id' => 2,
            'buyer_id' => 1,
            'product_id' => 1

        ];

        $transaction = Transaction::create($data);

    }
}
