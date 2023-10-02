<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guild_war', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guild_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('war_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('winner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guild_war');
    }
};
