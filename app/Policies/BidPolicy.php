<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Bid;
use Illuminate\Auth\Access\HandlesAuthorization;

class BidPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Bid $bid)
    {
        return $user->id === $post->user_id;
    

}
