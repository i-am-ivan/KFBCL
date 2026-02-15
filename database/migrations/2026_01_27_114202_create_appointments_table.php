<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_id')->unique()->nullable();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email');
            $table->string('phone', 20);
            $table->string('type', 255);
            $table->dateTime('appointment_date');
            $table->string('company_name')->nullable();
            $table->enum('priority', ['High', 'Normal', 'Low', 'Critical'])->default('Normal');
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled', 'Completed', 'Rescheduled'])->default('Pending');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            // Indexes
            $table->index('appointment_date');
            $table->index('status');
            $table->index('priority');
            $table->index('created_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
