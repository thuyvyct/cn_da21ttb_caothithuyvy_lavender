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
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->text('product_name');
            $table->text('product_desc');
            $table->string('product_price');
            $table->string('product_image');
            $table->string('product_size');
            $table->integer('product_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_product');
    }
};
