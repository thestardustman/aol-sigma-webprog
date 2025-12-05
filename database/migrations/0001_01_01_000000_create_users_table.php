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
        Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('nomor_telepon')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->string('tempat_lahir')->nullable();
        $table->text('alamat')->nullable();
        $table->string('kota')->nullable();
        $table->string('provinsi')->nullable();
        $table->string('negara')->nullable();
        $table->string('kode_zip')->nullable();
        $table->string('gender')->nullable();

        $table->timestamps();
    });

    }
    
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
