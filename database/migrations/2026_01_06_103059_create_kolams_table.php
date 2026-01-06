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
        Schema::create('kolams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kolam', 100);
            $table->string('jenis_ikan', 100);
            $table->integer('kapasitas');
            $table->string('lokasi', 100);
            $table->dateTime('tanggal_dibuat')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kolams');
    }
};
