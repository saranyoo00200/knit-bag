<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('amount_products')->nullable()->comment('จำนวนสินค้า');
            $table->date('paymentDate')->nullable()->comment('วันที่ซำระเงิน');
            $table->time('paymentTime')->nullable()->comment('เวลาซำระเงิน');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
