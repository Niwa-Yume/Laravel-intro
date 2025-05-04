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
        Schema::table('room', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()                 // ← la clé est nullable => plus d’erreur 1452
                ->after('cinema_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('room', function (Blueprint $table) {
            // D’abord supprimer la contrainte, puis la colonne
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
