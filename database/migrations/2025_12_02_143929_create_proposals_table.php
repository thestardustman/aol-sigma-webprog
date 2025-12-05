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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained(); // User login

            // Info Aktivitas
            $table->string('nama_aktivitas');
            $table->date('tanggal_aktivitas');
            $table->text('alamat_aktivitas');
            $table->decimal('target_dana', 15, 2);

            // Penanggung Jawab
            $table->string('nama_pic');
            $table->string('tempat_lahir_pic');
            $table->date('tanggal_lahir_pic');
            $table->text('alamat_pic');
            $table->string('kota_pic');
            $table->string('provinsi_pic');
            $table->string('negara_pic');
            $table->string('kode_zip_pic');
            $table->string('gender_pic');

            // File
            $table->string('file_proposal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
