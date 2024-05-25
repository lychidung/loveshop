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
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_product");
            $table->foreign("id_product")->references("id")->on("products");
            
            $table->unsignedBigInteger("id_color");
            $table->foreign("id_color")->references("id")->on("product_colors");

            $table->integer("price");
            $table->integer("discount_price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_items');
    }
};
