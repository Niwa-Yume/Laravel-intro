<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {  // Changé de 'room' à 'rooms'
            $table->foreignId('user_id')
                ->nullable()
                ->after('cinema_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {  // Changé de 'room' à 'rooms'
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
