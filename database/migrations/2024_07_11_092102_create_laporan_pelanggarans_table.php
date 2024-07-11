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
        Schema::create('laporan_pelanggarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggaran_id');
            $table->text('address');
            $table->char('province_id', 2);
            $table->char('regency_id', 4);
            $table->char('district_id', 7);
            $table->char('village_id', 10);
            $table->float('latitude');
            $table->float('longitude');
            $table->unsignedBigInteger('assign_by');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('verif_by')->nullable();
            $table->timestamps();

            // foreign key
            $table->foreign('pelanggaran_id')->references('id')->on('pelanggarans')->onDelete('cascade');
            $table->foreign('assign_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('verif_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_pelanggarans');
    }
};
