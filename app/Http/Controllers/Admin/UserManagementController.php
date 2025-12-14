<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserManagementController extends Controller
{
    /**
     * Suspend / Unsuspend a user
     */
    public function toggle(User $user)
    {
        // Prevent admin from suspending themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot suspend yourself.');
        }

        $user->is_suspended = ! $user->is_suspended;
        $user->save();

        return back()->with('success', 'User status updated.');
    }
}
