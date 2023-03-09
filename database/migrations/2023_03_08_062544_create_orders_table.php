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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('customer_address_id');
            $table->unsignedBigInteger('discount_code_id')->nullable();
            $table->unsignedBigInteger('shipping_method_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->enum('status', ['pending', 'done', 'cancelled'])->default('pending');
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('customer_address_id')->references('id')->on('user_address');
            $table->foreign('discount_code_id')->references('id')->on('discount_code');
            $table->foreign('shipping_method_id')->references('id')->on('shipping_method');
            $table->foreign('payment_method_id')->references('id')->on('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
