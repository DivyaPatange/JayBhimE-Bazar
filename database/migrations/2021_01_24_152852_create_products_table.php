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
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('parent_sub_category');
            $table->string('sub_category')->nullable();
            $table->string('child_sub_category')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('product_name');
            $table->text('product_description');
            $table->string('product_img');
            $table->string('cost_price');
            $table->string('selling_price');
            $table->string('size')->nullable();
            $table->boolean('status');
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
