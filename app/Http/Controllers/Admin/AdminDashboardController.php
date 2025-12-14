<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->get();

        return view('admin.dashboard', compact('users'));
    }
}
