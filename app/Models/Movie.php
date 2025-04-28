<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'year', 'country_id', 'director_id', 'poster_url'
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function director()
    {
        return $this->belongsTo(Artist::class);
    }
    public function actors()
    {
        return $this->belongsToMany(Artist::class, 'artist_movie', 'movie_id', 'artist_id')
            ->withPivot('role_name');
    }


}
