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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('image_url')->nullable();
            $table->string('image_alt')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_main')->default(false)
                ->comment('Image shown on product card and big image on details page');
            $table->tinyInteger('status')->default(0)
                ->comment('0: Inactive, 1: Active, 2: Deleted');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
