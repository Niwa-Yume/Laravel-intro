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
        'image_path'
    ];

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
}
