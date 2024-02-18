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
        Schema::create('invoices', function (Blueprint $table) {
            $table->unsignedInteger('invoice_id')->autoIncrement();
            $table->string('invoice_number', 255);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('payment_id');
            $table->integer('total_price');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('payment_id')->references('payment_id')->on('payments');
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
        Schema::dropIfExists('invoices');
    }
};
