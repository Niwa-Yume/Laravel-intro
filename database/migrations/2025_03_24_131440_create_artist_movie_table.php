<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('artist_movie', function (Blueprint $table) {
            $table->id();
            $table->string('role_name', 20);
            $table->foreignId('movie_id')->constrained('movies');
            $table->foreignId('artist_id')->constrained('artists');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_movie');
    }
};
