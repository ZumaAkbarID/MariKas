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
        Schema::create('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('trx_code');
            $table->string('name');
            $table->string('phone_number');
            $table->bigInteger('amount');
            $table->integer('month');
            $table->integer('week');
            $table->string('payment_proof')->nullable();
            $table->string('status');
            $table->integer('user_id')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('approved_at')->nullable();
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
        Schema::dropIfExists('payments');
    }
};