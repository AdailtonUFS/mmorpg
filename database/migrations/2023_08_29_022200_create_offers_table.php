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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_item_id')->constrained('account_item');
            $table->foreignId('item_id')->constrained('items');
            $table->enum('status', ['open', 'closed']);
            $table->unsignedSmallInteger('quantity_offer');
            $table->unsignedSmallInteger('quantity_receive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
