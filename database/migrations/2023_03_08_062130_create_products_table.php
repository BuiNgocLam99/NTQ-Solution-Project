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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('main_image');
            $table->json('gallery_images')->nullable();
            $table->unsignedBigInteger('category_id');
            
            // $table->string('product_number')->unique();
            // $table->json('product_tags')->nullable();
            // $table->text('short_description');

            // General info
            // $table->string('manufacturer_name')->nullable();
            // $table->string('manufacturer_brand')->nullable();

            // Meta data
            // $table->string('meta_title')->nullable();
            // $table->text('meta_keywords')->nullable();
            // $table->text('meta_description')->nullable();

            // Status
            // $table->enum('status', ['draft', 'published', 'scheduled'])->default('published');
            // $table->enum('visibility', ['public', 'hidden'])->default('public');
            // $table->dateTime('publish_date_time')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
