<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateStagesTable extends Migration
{
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->bigIncrements('stageId');
            $table->string('location')->unique();
            $table->timestamp('established')->useCurrent();
            $table->unsignedBigInteger('manager')->nullable(); // references members.memberId
            $table->unsignedBigInteger('author'); // references users.id
            $table->string('status')->nullable();
            $table->timestamp('created_on')->useCurrent();
            $table->timestamp('updated_on')->nullable()->useCurrentOnUpdate();

            $table->foreign('manager')->references('memberId')->on('members')->onDelete('set null');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
        });

        DB::statement('ALTER TABLE stages AUTO_INCREMENT = 101;');
    }

    public function down()
    {
        Schema::dropIfExists('stages');
    }
}