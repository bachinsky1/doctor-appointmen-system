<?php

namespace App\Http\Controllers;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user = Auth::user()->load('roles');
        $role = $user->roles->first(); 
        
        return view('dashboard', [
            'role' => $role,
            // 'roleName' => $role->name,
            // 'roleSlug' => $role->slug
        ]);
    }
}
