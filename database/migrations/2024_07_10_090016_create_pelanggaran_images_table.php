<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelanggaran_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggaran_id');
            $table->string('image');
            $table->timestamps();

            // Foreign key
            $table->foreign('pelanggaran_id')->references('id')->on('pelanggarans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggaran_images');
    }
};
