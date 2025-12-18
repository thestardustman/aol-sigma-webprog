<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ktp_number')->nullable();
            $table->string('ktp_photo')->nullable();
            $table->string('selfie_photo')->nullable();
            $table->string('kyc_status')->nullable(); // pending, approved, rejected
            $table->timestamp('kyc_verified_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['ktp_number', 'ktp_photo', 'selfie_photo', 'kyc_status', 'kyc_verified_at']);
        });
    }
};
