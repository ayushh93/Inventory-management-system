<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('SET NULL');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('SET NULL');
            $table->string('product_name');
            $table->string('slug')->unique();
            $table->float('price',10,2);
            $table->string('featured_image')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('featured_product');
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
};
