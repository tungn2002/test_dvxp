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
        Schema::create('ve', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idghe')->nullable();
            $table->unsignedBigInteger('iduser')->nullable();
            $table->date('ngaymua');
            $table->timestamps();
            $table->foreign('idghe')->references('id')->on('ghe')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('iduser')->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ve');
    }
};
