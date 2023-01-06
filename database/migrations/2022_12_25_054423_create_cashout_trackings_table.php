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
        Schema::create('cashout_tracking', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->integer('user_id');
            $table->bigInteger('amount');
            $table->string('purpose');
            $table->string('cashout_proof');
            $table->dateTime("datetime");
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
        Schema::dropIfExists('cashout_tracking');
    }
};