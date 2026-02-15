<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMemberKinTable extends Migration
{
    public function up()
    {
        Schema::create('member_kin', function (Blueprint $table) {
            $table->bigIncrements('kin_id');
            $table->unsignedBigInteger('member'); // references members.memberId
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('relation')->nullable();
            $table->enum('status', ['Approved','Pending','Inactive'])->default('Pending');
            $table->timestamp('created_on')->useCurrent();
            $table->timestamp('updated_on')->nullable()->useCurrentOnUpdate();

            $table->foreign('member')->references('memberId')->on('members')->onDelete('cascade');
        });

        DB::statement('ALTER TABLE member_kin AUTO_INCREMENT = 101;');
    }

    public function down()
    {
        Schema::dropIfExists('member_kin');
    }
}
