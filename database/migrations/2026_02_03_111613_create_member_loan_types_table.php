<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_loan_types', function (Blueprint $table) {
            $table->id('loanId');
            $table->string('loan_type_name');
            $table->decimal('interest_rate', 10, 2);
            $table->decimal('max_amount', 10, 2);
            $table->integer('repayment_period_months');
            $table->unsignedBigInteger('author');
            $table->timestamp('created_on')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_on')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string('status')->default('active');

            $table->foreign('author')->references('id')->on('users');
        });

        DB::statement("ALTER TABLE member_loan_types AUTO_INCREMENT = 1001;");
    }

    public function down(): void
    {
        Schema::dropIfExists('member_loan_types');
    }
};
