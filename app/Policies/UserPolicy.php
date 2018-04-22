<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{

    /**
     * Determine if the given User can be updated.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function update(User $user)
    {
      return (Auth::guard()->id() === $user->id) || $user->isRootUser();
    }

    /**
     * Determine if the given User can be deleted.
     *
     * @param  \App\User  $user
     * @return bool
     */
    public function destroy(User $user)
    {
      return $user->isRootUser();
    }
}
