<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('real_estate_clients', function (Blueprint $table) {
            $table->bigIncrements('real_estate_client_id');
            $table->string('real_estate_fname');
            $table->string('real_estate_lname');
            $table->string('real_estate_email')->unique();
            $table->string('real_estate_phone')->unique();
            $table->string('real_estate_id_number')->unique(); // National ID / Passport
            $table->string('real_estate_KRA')->unique()->nullable(); // Kenya Revenue Authority PIN
            $table->string('real_estate_status')->default('Active'); // Active, Inactive
            $table->unsignedBigInteger('created_by');
            $table->timestamp('created_on')->useCurrent();
            $table->timestamp('updated_on')->nullable()->useCurrentOnUpdate();

            // Foreign Keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        // set auto increment start to 11
        DB::statement('ALTER TABLE real_estate_clients AUTO_INCREMENT = 11;');
    }

    public function down(): void
    {
        Schema::dropIfExists('real_estate_clients');
    }
};
