<?php

namespace App\Policies;

use App\Models\PricingSuplier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PricingSupplierPolicy
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
     * @param  \App\Models\PricingSuplier  $pricingSuplier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PricingSuplier $pricingSuplier)
    {
        //
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
     * @param  \App\Models\PricingSuplier  $pricingSuplier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PricingSuplier $pricingSuplier)
    {
        return $user->isSuperAdmin() || $user->isAdmin() || $user->isDirector();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PricingSuplier  $pricingSuplier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PricingSuplier $pricingSuplier)
    {
        return $user->isSuperAdmin() || $user->isAdmin() || $user->isDirector();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PricingSuplier  $pricingSuplier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PricingSuplier $pricingSuplier)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PricingSuplier  $pricingSuplier
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PricingSuplier $pricingSuplier)
    {
        //
    }

    public function before(User $user, $ability)
    {
        return $user->isSuperAdmin() || $user->isAdmin() || $user->isDirector();
    }
}
