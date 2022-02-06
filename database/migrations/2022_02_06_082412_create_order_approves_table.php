<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderApprovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_approves', function (Blueprint $table) {
            $table->id();
            $table->string('fname', 30)->nullable()->comment('ชื่อ');
            $table->string('lname', 30)->nullable()->comment('นามสกุล');
            $table->string('address', 255)->nullable()->comment('ที่อยู่');
            $table->string('tel', 10)->nullable()->comment('เบอร์โทร');
            $table->string('subdistrict', 50)->nullable()->comment('ตำบล');
            $table->string('district', 50)->nullable()->comment('อำเภอ');
            $table->string('province', 50)->nullable()->comment('จังหวัด');
            $table->string('code_zip', 5)->nullable()->comment('เลขไปรษณีย์');
            $table->string('bank', 30)->nullable()->comment('ธนาคาร');
            $table->string('PaymentImage')->nullable()->comment('รูปสลิปซำระเงิน');
            $table->date('paymentDate')->nullable()->comment('วันที่ซำระเงิน');
            $table->time('paymentTime')->nullable()->comment('เวลาซำระเงิน');
            $table->string('bankTransfer')->nullable()->comment('โอนเงินผ่านธนาคาร');
            $table->string('toBank')->nullable()->comment('ไปยังธนาคาร');
            $table->string('amount_money')->nullable()->comment('จำนวนเงิน');
            $table->string('paymentCode')->nullable()->comment('โอนเงินผ่านบัญชีธนาคารเลข 4 หลักสุดท้าย');
            $table->boolean('approvel')->default(0)->comment('อนุมัติ');
            $table->unsignedBigInteger('user_id');
            $table->string('product_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('order_approves');
    }
}
