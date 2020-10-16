<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('description', 100);
            $table->string('thumbnail');
            $table->double('price', 8, 2);
            $table->unsignedBigInteger('slot')->nullable();
            $table->unsignedBigInteger('available_slot')->nullable();
            $table->unsignedBigInteger('percentage');
            $table->unsignedBigInteger('duration');
            $table->boolean('isActive', 1)->default(1);
            $table->boolean('isComplete', 1)->default(0);
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
        Schema::dropIfExists('investments');
    }
}
