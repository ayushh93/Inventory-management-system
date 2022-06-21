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
        Schema::create('sales_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productAttribute_id')->constrained('product_attributes');
            $table->string('SKU');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->float('price',8,2);
            $table->integer('quantity')->unsigned();
            $table->string('sold_by');
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
        Schema::dropIfExists('sales_logs');
    }
};
