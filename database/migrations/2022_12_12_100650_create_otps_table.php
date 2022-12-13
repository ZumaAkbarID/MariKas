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
        Schema::create('otp', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->integer('user_id')->nullable();
            $table->string('code', 10);
            $table->string('desc')->nullable();
            $table->string('phone_number');
            $table->enum('status', ['available', 'used', 'expire'])->default('available');
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
        Schema::dropIfExists('otp');
    }
};