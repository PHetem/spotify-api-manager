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
            $table->string('spotifyID');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('country');
            $table->string('followerCount');
            $table->string('profileURL');
            $table->string('profilePictureURL')->nullable();
            $table->string('accountType');
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
