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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->decimal('nilai');
            $table->unsignedBigInteger('pelamar_id')->nullable();
            $table->foreign('pelamar_id')->references('id')->on('pelamar')->onDelete('cascade');
            $table->unsignedBigInteger('kriteria_id')->nullable();
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
