<?php

namespace App\Policies;

use App\Models\DocumentVente;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentVentePolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DocumentVente  $documentVente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, DocumentVente $documentVente)
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DocumentVente  $documentVente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DocumentVente $documentVente)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DocumentVente  $documentVente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, DocumentVente $documentVente)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DocumentVente  $documentVente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, DocumentVente $documentVente)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DocumentVente  $documentVente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, DocumentVente $documentVente)
    {
        //
    }

    public function makePayment(User $user)
    {
        return !$user->isFacturation();
    }

    public function print(User $user)
    {
        return $user->isSuperAdmin() || $user->isFacturation();
    }

    public function terminate(User $user)
    {
        return $user->isSuperAdmin() || $user->isFacturation();
    }

    public function cancel(User $user, DocumentVente $documentVente)
    {
        return $user->isSuperAdmin() ||
            // ($documentVente->invoice_status != "paid") &&
            $user->isFacturation();
    }

    public function commercialState(User $user)
    {
        return $user->isSuperAdmin() || $user->isAdmin() || $user->isDirector();
    }
}
