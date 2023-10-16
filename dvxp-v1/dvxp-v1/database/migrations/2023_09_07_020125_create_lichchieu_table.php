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
        Schema::create('lichchieu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idphong')->nullable();
            $table->unsignedBigInteger('idphim')->nullable();
            $table->date('ngaychieu');
            $table->time('giochieu');
            $table->time('gioketthuc');
            $table->timestamps();
            // Định nghĩa khóa ngoại
            $table->foreign('idphong')->references('id')->on('phong')->onDelete('cascade')->onUpdate('cascade');
            // Định nghĩa khóa ngoại
            $table->foreign('idphim')->references('id')->on('phim')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lichchieu');
    }
};
