<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory;
    //use SoftDeletes;
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
    public function hasDirected()
    {
        return $this->hasMany(Movie::class, 'director_id');
    }
    public function hasPlayed()
    {
        return $this->belongsToMany(Movie::class)->withPivot('role_name');
    }
    public function films()
    {
        return $this->belongsToMany(Film::class, 'artist_film');
    }

}
