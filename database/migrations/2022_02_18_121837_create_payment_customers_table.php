<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_customers', function (Blueprint $table) {
            $table->id();
            $table->string('seller_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('card_number')->nullable();
            $table->string('cvv')->nullable();
            $table->string('expiration_month')->nullable();
            $table->string('expiration_year')->nullable();
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
        Schema::dropIfExists('payment_customers');
    }
}
