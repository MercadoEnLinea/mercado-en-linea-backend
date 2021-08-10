<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Tests\TestCase;

class TransactionTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test that a purchase can be stored
     *
     * @return void
     */
    public function test_create() : void
    {

        $data = [
            'seller_id' => 2,
            'buyer_id' => 1,
            'product_id' => 1

            ];

        $transaction = Transaction::create($data);



        $this->assertDatabaseHas('transactions',[
            'id'=> $transaction->id,
            'seller_id' => 2,
            'buyer_id' => 1,
            'product_id' => 1


        ]);
    }
}
