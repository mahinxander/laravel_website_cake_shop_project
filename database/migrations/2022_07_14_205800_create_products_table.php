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
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('title', 128)->unique();
            $table->string('slug', 156)->unique();
            $table->longText('description');
            $table->string('image_prod')->nullable();
            $table->tinyInteger('in_stock')->default(1);
            $table->decimal('price', 8,2);
            $table->decimal('sale_price', 8,2)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
