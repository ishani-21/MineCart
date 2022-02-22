<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerStorePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_store_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('saller_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('membership_id')->nullable();
            $table->string('duration')->nullable();
            $table->decimal('price')->nullable(); 
            $table->boolean('status')->default(0)->comment('0 - approve ,1 - rejected');
            $table->boolean('payment_status')->default(0)->comment('0 - panding, 1 - success, 2 - fail');
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
        Schema::dropIfExists('seller_store_plans');
    }
}
