<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->string('action'); // approved, rejected
            $table->string('target_type'); // user, campaign
            $table->unsignedBigInteger('target_id');
            $table->text('reason'); // Admin's internal reason for audit
            $table->text('feedback')->nullable(); // Message shown to user if rejected
            $table->timestamps();

            $table->index(['target_type', 'target_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_logs');
    }
};
