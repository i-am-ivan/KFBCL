<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_loans', function (Blueprint $table) {
            $table->id('transactionId')->startingValue(202601);
            $table->unsignedBigInteger('memberId');
            $table->unsignedBigInteger('transactionLoan');
            $table->decimal('transactionLoanAmount', 15, 2);
            $table->integer('transactionLoanPeriod');
            $table->timestamp('transactionLoanStartDate')->useCurrent();
            $table->integer('transactionLoanRepaymentMode');
            $table->unsignedBigInteger('transactionAuthor');
            $table->timestamp('transactionCreated')->useCurrent();
            $table->timestamp('transactionUpdatedOn')->useCurrent()->useCurrentOnUpdate();
            $table->enum('transactionLoanStatus',['Active','Stopped','Repaid','Defaulted']);
            $table->enum('transactionStatus', ['Approved', 'Under Review', 'Cancelled']);

            $table->foreign('memberId')->references('memberId')->on('members');
            $table->foreign('transactionLoan')->references('loanId')->on('member_loan_types');
            $table->foreign('transactionAuthor')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_loans');
    }
};
