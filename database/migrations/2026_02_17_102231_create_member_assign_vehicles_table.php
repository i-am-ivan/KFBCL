<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('member_assign_vehicles', function (Blueprint $table) {
            $table->id('assignedId');
            $table->unsignedBigInteger('rider'); // member.memberId
            $table->unsignedBigInteger('vehicle'); // members_vehicles.vehicleId
            $table->timestamp('assignedDate')->useCurrent();
            $table->string('status')->default('Assigned'); // Assigned, Re-Assigned
            $table->unsignedBigInteger('author')->nullable();
            $table->timestamp('updated_on')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();
            
            // Foreign keys (optional but recommended)
            $table->foreign('rider')->references('memberId')->on('members')->onDelete('cascade');
            $table->foreign('vehicle')->references('vehicleId')->on('members_vehicles')->onDelete('cascade');
            $table->foreign('author')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('member_assign_vehicles');
    }
};
