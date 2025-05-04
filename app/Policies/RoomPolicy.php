<?php

namespace App\Policies;  // Changé de App\Http\Controllers à App\Policies

use App\Models\Room;
use App\Models\User;

class RoomPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Room $room): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user, Room $room): bool
    {
        return $user->id === $room->user_id;
    }

    public function delete(User $user, Room $room): bool
    {
        return $user->id === $room->user_id;
    }
}
