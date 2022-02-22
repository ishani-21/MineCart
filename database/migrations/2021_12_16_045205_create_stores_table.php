<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('en_name')->nullable();
            $table->string('ar_name')->nullable();
            $table->integer('saller_id')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->longText('en_description')->nullable();
            $table->longText('ar_description')->nullable();
            $table->boolean('status')->default(0)->comment('0 - active, 1 - deactive');
            $table->boolean('is_approve')->default(0)->comment('0 - pending, 1 - approve, 2 - rejected');
            $table->string('slug')->nullable();
            $table->timestamps();  
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
