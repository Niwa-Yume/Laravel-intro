<?php

namespace App\Policies;

use App\Models\Showtime;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShowtimePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user)
    {
        return true; // Tout le monde peut voir la liste
    }

    public function view(?User $user, Showtime $showtime)
    {
        return true; // Tout le monde peut voir les détails
    }

    public function create(User $user)
    {
        return auth()->check(); // Utilisateur connecté uniquement
    }

    public function update(User $user, Showtime $showtime): bool
    {
        return $user->id === $showtime->user_id || $showtime->user_id === null;
    }

    public function delete(User $user, Showtime $showtime)
    {
        return $user->id === $showtime->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Showtime $showtime): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Showtime $showtime): bool
    {
        return false;
    }
}
