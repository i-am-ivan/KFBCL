<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_bonuses', function (Blueprint $table) {
            $table->id('transactionId')->startingValue(202601);
            $table->unsignedBigInteger('memberId');
            $table->unsignedBigInteger('transactionBonus');
            $table->string('transactionCode', 255);
            $table->decimal('transactionAmount', 10, 2);
            $table->timestamp('transactionDate')->useCurrent();
            $table->string('transactionMode', 100);
            $table->unsignedBigInteger('transactionAuthor');
            $table->timestamp('transactionUpdatedOn')->useCurrent()->useCurrentOnUpdate();
            $table->enum('transactionStatus', ['Approved', 'Pending', 'Cancelled', 'Reversed']);

            $table->foreign('memberId')->references('memberId')->on('members');
            $table->foreign('transactionBonus')->references('bonusId')->on('member_bonus_types');
            $table->foreign('transactionAuthor')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_bonuses');
    }
};
