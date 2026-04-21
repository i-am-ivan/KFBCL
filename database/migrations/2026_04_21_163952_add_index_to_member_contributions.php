<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToMemberContributions extends Migration
{
    public function up()
    {
        Schema::table('member_contributions', function (Blueprint $table) {
            $table->index(['memberId', 'transactionStatus', 'transactionType', 'transactionDate'], 'idx_member_contrib_latest');
        });
    }

    public function down()
    {
        Schema::table('member_contributions', function (Blueprint $table) {
            $table->dropIndex('idx_member_contrib_latest');
        });
    }
}
