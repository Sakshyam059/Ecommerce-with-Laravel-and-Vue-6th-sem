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
            $table->string('name');
            $table->text('description');
            $table->foreignId("category_id")->constrained()->onDelete('cascade');
            $table->unsignedInteger('base_price');
            $table->string('stock');
            $table->string('image');
            $table->unsignedInteger('discount');
            $table->string('discount_type');
            $table->unsignedInteger('total_price');
            $table->unsignedInteger('rating')->max(5)->default(0);
            $table->timestamps();
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
