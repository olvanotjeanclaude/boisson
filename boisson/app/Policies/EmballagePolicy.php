<?php

namespace App\Policies;

use App\Models\Emballage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmballagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Emballage  $emballage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Emballage $emballage)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isSuperAdmin() || $user->isAdmin() || $user->isDirector();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Emballage  $emballage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Emballage $emballage)
    {
        return $user->isSuperAdmin() || $user->isAdmin() || $user->isDirector();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Emballage  $emballage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Emballage $emballage)
    {
        return $user->isSuperAdmin() || $user->isAdmin() || $user->isDirector();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Emballage  $emballage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Emballage $emballage)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Emballage  $emballage
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Emballage $emballage)
    {
        //
    }
}
