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
        Schema::table('artists', function (Blueprint $table) {
            $table->foreignId('country_id')
                ->nullable()->after('birthdate')
                ->constrained('countries');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn(['country_id']);
        });
    }
};
