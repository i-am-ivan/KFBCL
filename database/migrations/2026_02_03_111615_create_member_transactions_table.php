<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_transactions', function (Blueprint $table) {
            $table->id('transactionCode');
            $table->unsignedBigInteger('member');
            $table->string('transaction_type');
            $table->decimal('transaction_amount', 15, 2);
            $table->string('transactionMethod');
            $table->decimal('amount', 15, 2);
            $table->date('transaction_date');
            $table->text('description')->nullable();
            $table->string('payment_method');
            $table->unsignedBigInteger('author');
            $table->timestamp('created_on')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_on')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string('status')->default('pending');

            $table->foreign('member')->references('memberId')->on('members');
            $table->foreign('author')->references('id')->on('users');
        });

        DB::statement("ALTER TABLE member_transactions AUTO_INCREMENT = 11;");
    }

    public function down(): void
    {
        Schema::dropIfExists('member_transactions');
    }
};
