<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;

    // SUPERUSER ACCESS
    public function before(?User $user, string $ability): ?bool
    {
        if ($user) {
            if ($user?->is_admin /* && $ability === 'update' */) {
                return true;
            }
        }
        return null;
    }

    public function nonAdmin(): bool
    {
        return false;
    }

    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Listing $listing): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        // CHANGE LATER
        return $user->is_admin;
    }

    public function update(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }

    public function delete(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }

    public function restore(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }

    public function forceDelete(User $user, Listing $listing): bool
    {
        return $user->id === $listing->by_user_id;
    }
}
