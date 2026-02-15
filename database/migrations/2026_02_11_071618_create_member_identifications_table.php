<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_identifications', function (Blueprint $table) {
            $table->id('identification_code'); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('member_id')->unique();
            $table->string('national_id', 50)->unique();
            $table->string('driver_license', 50)->unique();
            $table->string('driving_license_type', 100)->nullable();
            $table->string('ntsa_compliance', 20)->default('Pending');
            $table->string('national_id_front_path', 255)->nullable();
            $table->string('national_id_back_path', 255)->nullable();
            $table->unsignedBigInteger('author');
            $table->string('status', 20)->default('Pending');
            $table->timestamps(); // created_at, updated_at

            // Foreign keys
            $table->foreign('member_id')
                  ->references('memberId')
                  ->on('members')
                  ->onDelete('cascade');

            $table->foreign('author')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_identifications');
    }
};