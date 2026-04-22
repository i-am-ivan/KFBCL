<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberBonusFineTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('member_bonus_fine_transactions', function (Blueprint $table) {
            
            $table->bigIncrements('transactionID');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('bonus_type_id')->nullable();
            $table->unsignedBigInteger('fine_type_id')->nullable();
            $table->decimal('transactionAmount', 15, 2);
            $table->datetime('transactionDate');
            $table->string('transactionMode');
            $table->string('transactionCode')->nullable();
            $table->string('transactionStatus');
            $table->unsignedBigInteger('transactionAuthor')->nullable(); // ← changed to nullable
            $table->timestamp('created_on')->useCurrent();
            $table->timestamp('transactionUpdated_On')->nullable();

            $table->index('member_id');
            $table->index('bonus_type_id');
            $table->index('fine_type_id');
            $table->index('transactionAuthor');

            $table->foreign('member_id')->references('memberId')->on('members')->onDelete('cascade');
            $table->foreign('bonus_type_id')->references('bonusId')->on('member_bonus_types')->onDelete('cascade');
            $table->foreign('fine_type_id')->references('fineId')->on('member_fine_types')->onDelete('cascade');
            $table->foreign('transactionAuthor')->references('id')->on('users')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('member_bonus_fine_transactions');
    }
}
