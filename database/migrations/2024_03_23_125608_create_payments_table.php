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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete('cascade');
            $table->foreignId("product_id")->constrained()->onDelete('cascade');
            $table->string("ref_id")->nullable();
            $table->string("amount");
            // $table->string("discount_amount");
            // $table->string("net_amount");
            $table->string("payment_status")->nullable();
            $table->string("payment_mode")->nullable();
            $table->timestamp("request_date")->nullable();
            $table->timestamp("response_date")->nullable();
            // $table->unsignedBigInteger("order_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
