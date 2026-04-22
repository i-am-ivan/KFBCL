<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('real_estate_units', function (Blueprint $table) {
            $table->bigIncrements('real_estate_unit_id');
            $table->string('real_estate_unit_name')->unique();
            $table->string('real_estate_location');
            $table->string('real_estate_license_number')->unique()->nullable();
            $table->decimal('real_estate_valuation', 12, 2);
            $table->string('real_estate_ownership')->default('Under Review'); // e.g., 'Developer', 'Individual'
            $table->string('real_estate_status')->default('Available'); // Available, Sold, Reserved
            $table->unsignedBigInteger('created_by');
            $table->timestamp('created_on')->useCurrent();
            $table->timestamp('updated_on')->nullable()->useCurrentOnUpdate();

            // Foreign Keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });

        // set auto increment start to 11
        DB::statement('ALTER TABLE real_estate_units AUTO_INCREMENT = 11;');
    }

    public function down(): void
    {
        Schema::dropIfExists('real_estate_units');
    }
};
