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
    public function viewAny(?User $user)
    {
        return true; // Tout le monde peut voir la liste
    }

    public function view(?User $user, Artist $artist)
    {
        return true; // Tout le monde peut voir les détails
    }

    public function create(User $user)
    {
        return auth()->check(); // Utilisateur connecté uniquement
    }

    public function update(User $user, Artist $artist)
    {
        return $user->id === $artist->user_id;
    }

    public function delete(User $user, Artist $artist)
    {
        return $user->id === $artist->user_id;
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
