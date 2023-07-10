<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{

    /**
     * Determine whether the user can edit models.
     */
    public function edit(User $user): bool
    {
        return $user->hasPermission('update_categories');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('create_categories');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasPermission('update_categories');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->hasPermission('remove_categories');
    }
    /**
     * Determine whether the user can view any models.
     */
    public function adminList(User $user): bool
    {
        return $user->hasPermission('admin_list_categories');
    }
}
