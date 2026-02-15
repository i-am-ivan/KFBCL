<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMembersTable extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('memberId');                      // primary starting from 101 (see DB::statement)
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phone1')->unique();
            $table->string('phone2')->nullable();
            $table->string('nationalID')->unique();
            $table->binary('nationalID_front')->nullable();
            $table->binary('nationalID_back')->nullable();
            $table->string('license_type')->nullable();
            $table->string('license_number')->unique()->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('author'); // references users.id
            $table->timestamp('created_on')->useCurrent();
            $table->timestamp('updated_on')->nullable()->useCurrentOnUpdate();
            $table->enum('membership', ['Member', 'Non-Member'])->default('Non-Member');
            $table->enum('status', ['Active','Suspended','In-active','Blacklisted'])->default('Active');

            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
        });

        // set auto increment start to 101
        DB::statement('ALTER TABLE members AUTO_INCREMENT = 101;');
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }
}