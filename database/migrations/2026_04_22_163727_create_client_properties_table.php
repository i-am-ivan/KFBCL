<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('real_estate_client_properties', function (Blueprint $table) {
            $table->bigIncrements('real_estate_property_id');
            $table->foreignId('real_estate_client')->constrained('real_estate_clients', 'real_estate_client_id')->cascadeOnDelete();
            $table->foreignId('real_estate_unit')->constrained('real_estate_units', 'real_estate_unit_id')->cascadeOnDelete();
            $table->timestamp('real_estate_purchase_date')->useCurrent();
            $table->decimal('real_estate_purchase_amount', 12, 2);
            $table->string('real_estate_purchase_status')->default('Pending'); // Pending, Completed, Cancelled
            $table->unsignedBigInteger('created_by');
            $table->timestamp('updated_on')->nullable()->useCurrentOnUpdate();

            // Foreign Keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        // set auto increment start to 11
        DB::statement('ALTER TABLE real_estate_client_properties AUTO_INCREMENT = 11;');

    }

    public function down(): void
    {
        Schema::dropIfExists('real_estate_client_properties');
    }
};
