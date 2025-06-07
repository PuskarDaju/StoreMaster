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
    Schema::create('stock_history', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('product_id');
        $table->enum('change_type', ['restock', 'sale', 'adjustment']); // Corrected this line
        $table->integer('quantity_change');
        $table->timestamps();

        $table->foreign('product_id')->references('id')->on('products');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_history');
    }
};
