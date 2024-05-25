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
        Schema::create('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger("id_order");
            $table->foreign("id_order")->references("id")->on("orders");
            
            $table->unsignedBigInteger("id_product_variation_sizes");
            $table->foreign("id_product_variation_sizes")->references("id")->on("product_variation_sizes");
            $table->integer("price");
            $table->integer("quantity");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
