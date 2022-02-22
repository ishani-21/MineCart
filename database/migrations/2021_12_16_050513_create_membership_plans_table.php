<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_plans', function (Blueprint $table) {
            $table->id();
            $table->string('en_package_name')->nullable();
            $table->string('ar_package_name')->nullable();
            $table->decimal('price')->nullable();
            $table->string('duration')->nullable();
            $table->longText('en_discription')->nullable();
            $table->longText('ar_discription')->nullable();
            $table->boolean('status')->default(0)->comment('0 - start, 1 - expired');
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
        Schema::dropIfExists('membership_plans');
    }
}
