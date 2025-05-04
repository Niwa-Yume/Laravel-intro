<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MoviePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true; // Tout le monde peut voir la liste
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Movie $movie): bool
    {
        return true; // Tout le monde peut voir les détails
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->check(); // Utilisateur connecté uniquement
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Movie $movie): bool
    {
        return $user->id === $movie->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Movie $movie): bool
    {
        return $user->id === $movie->user_id;
    }
}
