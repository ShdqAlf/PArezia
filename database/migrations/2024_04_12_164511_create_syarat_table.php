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
        Schema::create('syarat', function (Blueprint $table) {
            $table->id();
            $table->string('cv');
            $table->string('dokumen_lainnya');
            $table->unsignedBigInteger('lowongan_id');
            $table->foreign('lowongan_id')->references('id')->on('lowongan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat');
    }
};
