<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_investments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascade('delete');
            $table->unsignedBigInteger('investment_id');
            $table->foreign('investment_id')->references('id')->on('investments')->cascade('delete');
            $table->string('payment_reference_key');
            $table->unsignedBigInteger('slot')->nullable();
            $table->double('amount', 8, 2);
            $table->date('start_date');
            $table->date('date_count');
            $table->date('end_date');
            $table->boolean('isPaid', 1)->default(0);
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
        Schema::dropIfExists('user_investments');
    }
}
