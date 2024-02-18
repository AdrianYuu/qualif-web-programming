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
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->autoIncrement();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('phone', 255);
            $table->string('password', 255);
            $table->string('address', 255);
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('role_id')->on('roles');
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
        Schema::dropIfExists('users');
    }
};
