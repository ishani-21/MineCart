<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('brand_id')->nullable();
            $table->string('country_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('bussiness_name')->nullable();
            $table->string('website')->nullable();
            $table->string('password')->nullable();
            $table->string('register_number')->nullable();
            $table->string('address')->nullable();
            $table->string('otp')->nullable();
            $table->boolean('is_approve')->default(0)->comment('0-Approve 1-Rejected');
            $table->string('rejected_reason')->nullable();
            $table->boolean('status')->default(0)->comment('0-Active 1-Inactive');
            $table->boolean('is_verify')->default(0)->comment('1-verify 0-inverify');
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('sellers');
    }
}