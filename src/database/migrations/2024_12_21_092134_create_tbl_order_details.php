<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_order_details', function (Blueprint $table) {
            $table->id('order_details_id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->string('product_name',100);
            $table->float('product_price');
            $table->integer('product_sales_quantity');
            $table->foreign('order_id')->references('order_id')->on('tbl_orrder')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('tbl_product')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_order_details');
    }
};
