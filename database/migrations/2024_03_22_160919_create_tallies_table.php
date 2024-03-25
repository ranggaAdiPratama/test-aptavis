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
        Schema::create('tallies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('club_id');
            $table->integer('score')->default(0);
            $table->integer('goal')->default(0);

            $table->foreign('club_id')
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
        Schema::dropIfExists('tallies');
    }
};
