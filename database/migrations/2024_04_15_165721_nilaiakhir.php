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
        Schema::create('nilaiakhir', function (Blueprint $table) {
            $table->id();
            $table->decimal('nilaiqi');
            $table->integer('rangking');
            $table->unsignedBigInteger('pelamar_id')->nullable();
            $table->foreign('pelamar_id')->references('id')->on('pelamar')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilaiakhir');
    }
};
