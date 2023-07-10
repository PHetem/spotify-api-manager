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
        Schema::create('top_tracks', function (Blueprint $table) {
            $table->id();
            $table->string('spotifyID');
            $table->string('customerID');
            $table->string('name');
            $table->string('imageURL')->nullable();
            $table->string('URL');
            $table->string('rank');
            $table->string('artist');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_tracks');
    }
};
