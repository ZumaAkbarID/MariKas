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
        Schema::create('u_details', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->bigInteger('user_id');
            $table->string('alias')->nullable();
            $table->string('kyc_document')->nullable();
            $table->string('kyc_selfie')->nullable();
            $table->enum('kyc', ['Lolos', 'Ditolak'])->nullable();
            $table->text('address');
            $table->string('profile')->nullable();
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
        Schema::dropIfExists('u_details');
    }
};
