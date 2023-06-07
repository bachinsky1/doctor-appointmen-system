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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->load('roles');
        $role = $user->roles->first(); 

        $allUsers = User::select('id', 'name', 'email', 'email_verified_at', 'created_at', 'updated_at', 'deleted_at')
            ->with('roles')
            ->withTrashed()
            ->whereNotIn('id', [Auth::user()->id])
            ->paginate(10);

        return view('dashboard', [
            'role' => $role,
            'allUsers' => $allUsers,
        ]);
    }
}
