<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_fine_types', function (Blueprint $table) {
            $table->id('fineId');
            $table->string('fine_name');
            $table->text('description');
            $table->decimal('percentage', 5, 2);
            $table->boolean('is_percentage')->default(false);
            $table->unsignedBigInteger('author');
            $table->timestamp('created_on')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_on')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->string('status')->default('active');

            $table->foreign('author')->references('id')->on('users');
        });

        DB::statement("ALTER TABLE member_fine_types AUTO_INCREMENT = 1001;");

    }

    public function down(): void
    {
        Schema::dropIfExists('member_fine_types');
    }
};
