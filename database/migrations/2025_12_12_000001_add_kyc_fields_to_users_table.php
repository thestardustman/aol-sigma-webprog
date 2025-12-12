<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ktp_number')->nullable()->after('gender');
            $table->string('ktp_photo')->nullable()->after('ktp_number');
            $table->string('selfie_photo')->nullable()->after('ktp_photo');
            $table->enum('kyc_status', ['pending', 'approved', 'rejected'])->nullable()->after('selfie_photo');
            $table->timestamp('kyc_verified_at')->nullable()->after('kyc_status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['ktp_number', 'ktp_photo', 'selfie_photo', 'kyc_status', 'kyc_verified_at']);
        });
    }
};
