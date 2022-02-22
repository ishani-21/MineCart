<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('stor_id')->nullable();
            $table->string('categories_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('en_productname')->nullable();
            $table->string('ar_productname')->nullable();
            $table->decimal('cost_price')->nullable();
            $table->decimal('regular_price')->nullable();
            $table->decimal('sale_price')->nullable();
            $table->string('cover_image')->nullable();
            $table->longtext('ar_discription')->nullable();
            $table->longtext('en_discription')->nullable();
            $table->string('status')->default(0)->comment('0-Active, 1-Inactive');
            $table->string('is_approve')->default(0)->comment('0-pending, 1-Aproove, 2-rejected');
            $table->string('rejected_reason')->nullable();
            $table->string('slug')->nullable();
            $table->string('total_qty')->nullable();
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
        Schema::dropIfExists('products');
    }
}