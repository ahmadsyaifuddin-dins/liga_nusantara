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
            $table->string('documentation')->nullable()->after('winner_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pes_matches', function (Blueprint $table) {
            $table->dropColumn('documentation');
        });
    }
};
