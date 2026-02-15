<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_bonus_types', function (Blueprint $table) {
            $table->id('bonusId');
            $table->string('bonus_name');
            $table->text('description')->nullable();
            $table->string('calculation_method');
            $table->decimal('percentage', 5, 2);
            $table->unsignedBigInteger('author');
            $table->timestamp('created_on')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_on')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string('status')->default('active');

            $table->foreign('author')->references('id')->on('users');
        });

        DB::statement("ALTER TABLE member_bonus_types AUTO_INCREMENT = 1001;");

    }

    public function down(): void
    {
        Schema::dropIfExists('member_bonus_types');
    }
};
