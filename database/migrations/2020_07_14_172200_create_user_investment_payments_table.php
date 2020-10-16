<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInvestmentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_investment_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascade('delete');
            $table->unsignedBigInteger('investment_id');
            $table->foreign('investment_id')->references('id')->on('investments')->cascade('delete');
            $table->unsignedBigInteger('user_investment_id');
            $table->foreign('user_investment_id')->references('id')->on('user_investments')->cascade('delete');
            $table->double('payout_amount', 8, 2);
            $table->boolean('isActive', 1)->default(0);
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
        Schema::dropIfExists('user_investment_payments');
    }
}
