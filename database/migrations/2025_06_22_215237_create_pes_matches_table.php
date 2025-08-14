<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pes_matches', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->foreignId('player_1_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('player_2_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('score_1');
            $table->unsignedTinyInteger('score_2');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pes_matches');
    }
};
