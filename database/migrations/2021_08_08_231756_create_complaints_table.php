<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('complainer_id');
            $table->index('complainer_id');
            $table->foreign('complainer_id')->references('id')->on('users');



            $table->unsignedBigInteger('accused_id');
            $table->index('accused_id');
            $table->foreign('accused_id')->references('id')->on('users');



            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->index('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions');


            $table->unsignedBigInteger('product_id')->nullable();
            $table->index('product_id');
            $table->foreign('product_id')->references('id')->on('products');



            $table->unsignedBigInteger('complaint_category_id')->nullable();
            $table->index('complaint_category_id');
            $table->foreign('complaint_category_id')->references('id')->on('complaint_categories');

            $table->longText('body');
            $table->integer('resolution_id')->default(\App\Models\Complaint::PENDING);



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
        Schema::dropIfExists('complaints');
    }
}
