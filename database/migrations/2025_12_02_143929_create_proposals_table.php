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
            $table->foreignId('user_id')->constrained('users')->onDelete('Cascade'); // User login

            // Info Aktivitas
            $table->string('activity_name');
            $table->date('activity_date');
            $table->text('activity_address');
            $table->decimal('target_amount', 15, 2);

            // Penanggung Jawab
            $table->string('pic_name');
            $table->string('pic_birth_place');
            $table->date('pic_birth_date');
            $table->text('pic_address');
            $table->string('pic_city');
            $table->string('pic_province');
            $table->string('pic_country');
            $table->string('pic_zip');
            $table->string('pic_gender');

            // File
            $table->string('proposal_file');
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
