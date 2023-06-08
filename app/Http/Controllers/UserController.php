<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'email_verified_at', 'created_at', 'updated_at', 'deleted_at')
            ->with('roles')
            ->withTrashed()
            ->whereNotIn('id', [Auth::user()->id])
            ->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        
        if ($user) {
            $user->delete();
            session()->flash('message', 'User has been deleted!');
            session()->flash('class', 'success'); 

            return redirect()->route('users');
        } else {
            session()->flash('message', 'User not found!');
            session()->flash('class', 'warning');
            
            return redirect()->route('users');
        }
    }
}
