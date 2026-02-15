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
        Schema::create('users_logins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('status', ['Active', 'Inactive', 'Suspended', 'Removed'])->default('Active');
            $table->enum('role', ['Chairman', 'Secretary', 'Treasurer', 'Supervisor', 'IT', 'Receptionist']);
            $table->string('token')->nullable();
            $table->string('session_id')->nullable();
            $table->timestamp('logged_in_at')->nullable();
            $table->timestamp('logged_out_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_logins');
    }
};
