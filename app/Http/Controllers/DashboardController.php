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
        $roles = Auth::user()->roles;

        // Check if user has any roles
        if ($roles->isEmpty()) {
            throw new \Exception("User doesn't have any roles");
        }

        // Return the appropriate dashboard view based on the user's role
        switch ($roles->first()->slug) {
            case 'administrator':
                return view('dashboard.admin');

            case 'health-professional':
                return view('dashboard.health-professional');

            case 'patient':
                return view('dashboard.patient');

            default:
                throw new \Exception("Unknown user role");
        }
    }

}