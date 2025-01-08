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
        Schema::table('tbl_size', function (Blueprint $table) {
            // Thêm hoặc chỉnh sửa cột ở đây
            $table->string('size_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
