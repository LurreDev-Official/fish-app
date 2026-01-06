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
      Schema::create('penggunaan_pakans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pakan_id')
            ->constrained('pakans')->onDelete('cascade');
            $table->foreignId('kolam_id')->constrained('kolams')->onDelete('cascade');
            $table->decimal('jumlah', 10, 2); // Jumlah pakan yang digunakan
            $table->datetime('tanggal');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_pakans');
    }
};
