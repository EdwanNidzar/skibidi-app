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
        Schema::create('surat_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat_kerja');
            $table->unsignedBigInteger('assign_by');
            $table->unsignedBigInteger('assign_to');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('assign_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assign_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_kerjas');
    }
};
