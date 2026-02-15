<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id('user_role_id')->startingValue(1001);
            $table->string('user_role', 200)->unique();
            $table->enum('user_role_status', ['Active', 'Pending', 'Suspended'])->default('Pending');
            $table->unsignedBigInteger('user_role_creator')->nullable();
            $table->timestamp('user_role_created_on')->useCurrent();
            $table->timestamp('user_role_updated_on')->nullable()->useCurrentOnUpdate();
            
            // Bodaboda privileges
            $table->boolean('user_role_bodaboda_create')->default(false);
            $table->boolean('user_role_bodaboda_read')->default(false);
            $table->boolean('user_role_bodaboda_update')->default(false);
            $table->boolean('user_role_bodaboda_delete')->default(false);
            
            // Loans privileges
            $table->boolean('user_role_loans_create')->default(false);
            $table->boolean('user_role_loans_read')->default(false);
            $table->boolean('user_role_loans_update')->default(false);
            $table->boolean('user_role_loans_delete')->default(false);
            
            // Real Estate/Lands privileges
            $table->boolean('user_role_lands_create')->default(false);
            $table->boolean('user_role_lands_read')->default(false);
            $table->boolean('user_role_lands_update')->default(false);
            $table->boolean('user_role_lands_delete')->default(false);
            
            // Foreign key constraint
            $table->foreign('user_role_creator')->references('id')->on('users')->onDelete('set null');
        });

        // Alternative if startingValue() doesn't work with your DB
        // DB::statement("ALTER TABLE user_roles AUTO_INCREMENT = 1001;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};