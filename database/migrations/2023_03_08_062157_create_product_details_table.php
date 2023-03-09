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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('product_details_number')->unique();
            $table->unsignedBigInteger('product_id');
            $table->string('color');
            $table->string('size');
            $table->decimal('weight', 8, 2);
            $table->integer('stock');
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2);
            $table->decimal('discount', 5, 2)->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
