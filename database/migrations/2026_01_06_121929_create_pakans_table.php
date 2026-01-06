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
       Schema::create('pakans', function (Blueprint $table) {
            // Menambahkan kolom 'pakan_id' sebagai primary key
            $table->id();
            // Kolom-kolom yang sesuai dengan tabel Pakan
            $table->string('nama_pakan', 100);
            $table->string('kategori', 50);
            $table->string('satuan', 20);
            $table->decimal('harga_per_kg', 10, 2);

            // Kolom timestamps untuk created_at dan updated_at secara otomatis
            $table->timestamps(); // Ini akan menambahkan kolom 'created_at' dan 'updated_at' otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakans');
    }
};
