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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained();
            $table->foreignId('class_id')->constrained();
            $table->string('name', 50);
            $table->unsignedSmallInteger('level');
            $table->decimal('damage');
            $table->decimal('defense');
            $table->decimal('resistance');
            $table->decimal('critical');
            $table->decimal('life');
            $table->unsignedSmallInteger('honor');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
