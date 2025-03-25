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
        Schema::table('movies', function (Blueprint $table) {
            $table->foreignId('director_id')
                ->nullable()->after('year')
                ->constrained('artists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropForeign(['director_id']);
            $table->dropColumn(['director_id']);
        });
    }
};
