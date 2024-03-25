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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('club_1');
            $table->unsignedBigInteger('club_2');
            $table->integer('win_score');
            $table->integer('lose_score');

            $table->foreign('club_1')
                ->references('id')
                ->on('clubs')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->foreign('club_2')
                ->references('id')
                ->on('clubs')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
