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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('password');
            $table->dateTime("birtday")->nullable();
            $table->string("address",100)->nullable();
            $table->integer("gender")->nullable();
            $table->string("image",500)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger("role")->nullable();
            $table->foreign("role")->references("id")->on("roles");
            $table->integer("status")->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
