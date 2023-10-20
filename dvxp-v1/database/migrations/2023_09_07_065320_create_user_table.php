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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('tenuser');
            $table->string('gioitinh');
            $table->date('ngaysinh');
            $table->string('diachi');
            $table->string('sdt');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('idchucvu')->nullable();
            $table->rememberToken();
            $table->timestamps();
            // Định nghĩa khóa ngoại
            $table->foreign('idchucvu')->references('id')->on('chucvu')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
