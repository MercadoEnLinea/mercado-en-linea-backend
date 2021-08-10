<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionReview;
use Tests\TestCase;

class TransactionReviewTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test that a purchase can be reviewd
     *
     * @return void
     */
    public function test_create(): void
    {


        $transaction = Transaction::find(1);




        $rol = TransactionReview::BUYER;
        $reviewedId = $transaction->seller_id;




        $data = [
            'transaction_id' => 1,
            'reviewer_id' => 1,
            'rol' => $rol,
            'reviewed_id' => $reviewedId

        ];

        $review = TransactionReview::create($data);

        $this->assertDatabaseHas('transaction_reviews', [
            'id' => $transaction->id,
            'reviewed_id' => 2,
            'reviewer_id' => 1,
            'transaction_id' => 1


        ]);
    }
}
