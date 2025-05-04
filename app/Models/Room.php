<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'cinema_id', 'capacity', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}


