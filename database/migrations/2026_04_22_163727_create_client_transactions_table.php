<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('real_estate_client_transactions', function (Blueprint $table) {
            $table->id('real_estate_transaction_id');
            $table->foreignId('real_estate_property')->constrained('real_estate_client_properties', 'real_estate_property_id')->cascadeOnDelete();
            $table->decimal('transaction_amount', 12, 2);
            $table->timestamp('transaction_date')->useCurrent();
            $table->string('transaction_status')->default('Pending'); // Pending, Completed, Failed
            $table->string('transaction_type'); // Deposit, Installment, Full Payment
            $table->string('transaction_mode'); // Cash, Bank Transfer, Cheque, M-Pesa
            $table->string('transaction_code')->unique(); // Receipt / Reference number
            $table->foreignId('created_by');
            $table->timestamp('updated_on')->useCurrent()->useCurrentOnUpdate();

            // Foreign Keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });

        // set auto increment start to 11
        DB::statement('ALTER TABLE real_estate_client_transactions AUTO_INCREMENT = 11;');
    }

    public function down(): void
    {
        Schema::dropIfExists('real_estate_client_transactions');
    }
};
