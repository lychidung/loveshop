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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string("voucher_name");
            $table->string("voucher_code")->unique();
            $table->enum("voucher_type", ['percent', 'fixed_amount'])->default('fixed_amount');
            $table->integer("value")->length(10);
            $table->date("start_date");
            $table->time("start_time");
            $table->date("end_date");
            $table->time("end_time");
            $table->integer("voucher_min_spend");
            $table->integer("voucher_max_spend");
            $table->integer("voucher_use_per_user")->default(1);
            $table->integer("quantity")->default(1);
            $table->string("image");
            $table->integer("status")->length(1)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
