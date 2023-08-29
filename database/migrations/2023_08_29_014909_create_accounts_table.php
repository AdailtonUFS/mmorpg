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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('user_cpf', 14);
            $table->foreignId('server_id')->constrained();
            $table->enum('status', ['active', 'banned', 'inactive'])->default('active');
            $table->unique(['user_cpf', 'server_id'], 'unique_account_in_server');
            $table->timestamps();

            $table->foreign('user_cpf')->references('cpf')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
