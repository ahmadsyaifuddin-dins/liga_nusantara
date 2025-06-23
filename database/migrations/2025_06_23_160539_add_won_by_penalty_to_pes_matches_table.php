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
        Schema::table('pes_matches', function (Blueprint $table) {
            $table->boolean('won_by_penalty')->default(false)->after('winner_id');
        });
    }

    public function down()
    {
        Schema::table('pes_matches', function (Blueprint $table) {
            $table->dropColumn('won_by_penalty');
        });
    }
};
