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
        Schema::create('a_p_i_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('token');
            $table->string('customerID')->default('0');
            $table->string('userID')->default('0');
            $table->string('expiresAt')->nullable();
            $table->timestamps();

            $table->unique(['type', 'userID', 'customerID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_p_i_tokens');
    }
};
