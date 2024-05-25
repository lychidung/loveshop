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
            $table->unsignedBigInteger("id_customer");
            $table->foreign("id_customer")->references("id")->on("customers");
            $table->unsignedBigInteger("id_user")->nullable();
            $table->foreign("id_user")->references("id")->on("users");
            $table->string("full_name",50);
            $table->integer("phone")->length(20);
            $table->string("email",20);
            $table->string("address",150);
            $table->longText("note")->nullable();
            $table->integer("total_amount");
            $table->date("date_order");
            $table->time("time_order");
            $table->date("canceled_at")->nullable();
            $table->date("delivery_at")->nullable();
            $table->string("payment_method")->nullable();
            $table->unsignedBigInteger("id_voucher")->nullable();
            $table->foreign("id_voucher")->references("id")->on("vouchers");
            $table->integer("status")->default(1);
            $table->timestamps();
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
