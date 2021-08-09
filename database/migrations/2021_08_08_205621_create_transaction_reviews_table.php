<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reviewer_id');
            $table->index('reviewer_id');
            $table->foreign('reviewer_id')->references('id')->on('users');

            $table->integer('rol')->default(\App\Models\TransactionReview::BUYER);


            $table->unsignedBigInteger('transaction_id');
            $table->index('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions');


            $table->unsignedBigInteger('reviewed_id');
            $table->index('reviewed_id');
            $table->foreign('reviewed_id')->references('id')->on('users');

            $table->integer('score')->default(1);
            $table->longText('body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_reviews');
    }
}
