<?php

namespace App\Policies;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArtistPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true; // Tout le monde peut voir la liste des artistes
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Artist $artist): bool
    {
        return true; // Tout le monde peut voir les détails d'un artiste
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Utilisateur connecté peut créer un artiste
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Artist $artist): bool
    {
        return $user->id === $artist->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Artist $artist): bool
    {
        // Vérifie si l'utilisateur est le propriétaire et si l'artiste n'a pas réalisé de films
        return $user->id === $artist->user_id && $artist->directedMovies()->count() === 0;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Artist $artist): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Artist $artist): bool
    {
        return false;
    }
}
