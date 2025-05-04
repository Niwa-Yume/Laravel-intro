<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'firstname',
        'country_id',
        'description',
        'image_path',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'artist_movie')
            ->withPivot('role_name');
    }

    // Relation pour les films réalisés
    public function directedMovies()
    {
        return $this->hasMany(Movie::class, 'director_id');
    }

    public function actors()
    {
        return $this->belongsToMany(Artist::class, 'artist_movie', 'movie_id', 'artist_id')
            ->wherePivot('role_name', '!=', 'Directeur')
            ->withPivot('role_name');
    }
}
