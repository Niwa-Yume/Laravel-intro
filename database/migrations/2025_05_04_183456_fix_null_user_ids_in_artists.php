<?php

use App\Models\Artist;
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
        $defaultUserId = 1; // ID de l'utilisateur par défaut

        Artist::whereNull('user_id')->update([
            'user_id' => $defaultUserId
        ]);
    }

    public function down()
    {
        Artist::where('user_id', 1)->update([
            'user_id' => null
        ]);
    }
};
