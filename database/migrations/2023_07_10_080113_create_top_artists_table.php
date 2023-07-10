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
        Schema::create('top_artists', function (Blueprint $table) {
            $table->id();
            $table->string('spotifyID');
            $table->string('customerID');
            $table->string('name');
            $table->string('imageURL')->nullable();
            $table->string('URL');
            $table->string('rank');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_artists');
    }
};
