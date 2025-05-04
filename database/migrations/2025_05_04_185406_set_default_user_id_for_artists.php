<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Artist;

class SetDefaultUserIdForArtists extends Migration
{
    public function up()
    {
        Artist::whereNull('user_id')->update(['user_id' => 1]);
    }

    public function down()
    {
        Artist::where('user_id', 1)->update(['user_id' => null]);
    }
}
