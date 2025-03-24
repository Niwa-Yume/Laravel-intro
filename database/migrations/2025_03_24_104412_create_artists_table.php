<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *  Pour mettre la data
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('firstname', 15);
            $table->year('birthdate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * pour enlever / vider de la data
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
