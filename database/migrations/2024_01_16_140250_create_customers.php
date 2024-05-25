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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("name",100);
            $table->string("password");
            $table->integer("phone")->length(20)->nullable()->unique();
            $table->string("email",100)->unique();
            $table->integer("point")->nullable()->length(10);
            $table->date("birthday")->nullable();
            $table->string("address",100)->nullable();
            $table->integer("gender")->nullable();
            $table->string("image",500)->nullable();
            $table->integer("status")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
