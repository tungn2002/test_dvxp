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
        Schema::create('ghe', function (Blueprint $table) {
            $table->id();
            $table->string('tenghe');
            $table->unsignedBigInteger('idphong')->nullable();
            $table->unsignedBigInteger('idlichchieu')->nullable();
            $table->double('giaghe');
            $table->timestamps();
            $table->foreign('idphong')->references('id')->on('phong')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idlichchieu')->references('id')->on('lichchieu')->onDelete('cascade')->onUpdate('cascade');


        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ghe');
    }
};
