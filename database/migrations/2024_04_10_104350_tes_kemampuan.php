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
        Schema::create('teskemampuan', function (Blueprint $table) {
            $table->id();
            $table->longText('keterangan');
            $table->string('file_download');
            $table->string('file_upload')->nullable();
            $table->unsignedBigInteger('pelamar_id')->nullable();
            $table->foreign('pelamar_id')->references('id')->on('pelamar')->onDelete('cascade');
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
        Schema::dropIfExists('teskemampuan');
    }
};
