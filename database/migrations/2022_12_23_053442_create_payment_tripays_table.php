<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_tripay', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('method');
            $table->string('merchant_ref');
            $table->bigInteger('amount');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('order_items');
            $table->string('signature');
            $table->string('checkout_url');
            $table->string('status');
            $table->integer('month');
            $table->integer('week');
            $table->bigInteger('paid_at')->nullable();
            $table->bigInteger('expired_time');
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
        Schema::dropIfExists('payment_tripay');
    }
};