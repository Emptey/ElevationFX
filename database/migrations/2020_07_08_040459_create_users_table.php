<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 45);
            $table->date('dob');
            $table->string('gender', 7);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('address', 255)->nullable();
            $table->string('phone', 11)->unique();
            $table->string('country', 150)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->boolean('isActive', 1)->default(1);
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
}
