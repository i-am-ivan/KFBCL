<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMemberVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('members_vehicles', function (Blueprint $table) {
            $table->bigIncrements('vehicleId');
            $table->unsignedBigInteger('member'); // references members.memberId
            $table->string('plate_number')->unique();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('brand')->nullable();
            $table->year('yom')->nullable();
            $table->string('CC')->nullable();
            $table->boolean('NTSA_compliant')->default(false);
            $table->string('availability')->default('Available');
            $table->timestamp('created_on')->useCurrent();
            $table->timestamp('updated_on')->nullable()->useCurrentOnUpdate();
            $table->string('insurance')->nullable();

            $table->foreign('member')->references('memberId')->on('members')->onDelete('cascade');
        });

        DB::statement('ALTER TABLE members_vehicles AUTO_INCREMENT = 101;');
    }

    public function down()
    {
        Schema::dropIfExists('members_vehicles');
    }
}