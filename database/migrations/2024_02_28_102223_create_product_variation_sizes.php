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
        Schema::create('product_variation_sizes', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger("id_product_item");
            $table->foreign("id_product_item")->references("id")->on("product_items");

            $table->unsignedBigInteger("id_size");
            $table->foreign("id_size")->references("id")->on("product_option_sizes");
            $table->integer("in_stock")->length(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variation_sizes');
    }
};
