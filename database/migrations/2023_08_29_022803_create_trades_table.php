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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_item_id_1')->constrained('account_item');
            $table->foreignId('account_item_id_2')->constrained('account_item');
            $table->foreignId('offer_id')->nullable()->constrained();
            $table->decimal('quantity_item_trade_account_1');
            $table->decimal('quantity_item_trade_account_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
