<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the dashboard based on user role
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        
        // Load user and their roles
        $user = Auth::user()->load('roles');

        // Get the user's roles
        $roles = $user->roles;

        // Check if user has any roles
        if ($roles->isEmpty()) {
            throw new \Exception("User doesn't have any roles");
        }

        // Return the appropriate dashboard view based on the user's role
        $mainRole = $roles->first()->slug;
        switch ($mainRole) {
            case 'administrator':
                // Get all users except current user and paginate them
                $users = User::select('id', 'name', 'email', 'email_verified_at', 'created_at', 'updated_at', 'deleted_at')
                    ->with('roles')
                    ->withTrashed()
                    ->whereNotIn('id', [Auth::user()->id])
                    ->paginate(10);

                return view('dashboard.admin', [
                    'roles' => $roles,
                    'users' => $users,
                ]);

            case 'health-professional':
                return view('dashboard.health-professional', [
                    'roles' => $roles,
                ]);

            case 'patient':
                return view('dashboard.patient', [
                    'roles' => $roles,
                ]);

            default:
                throw new \Exception("Unknown user role");
        }
    }

}