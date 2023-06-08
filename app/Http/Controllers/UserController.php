<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy($id)
    {
        $user = User::find($id);
        
        if ($user) {
            $user->delete();
            session()->flash('message', 'User has been deleted!');
            session()->flash('class', 'success'); 

            return redirect()->route('dashboard');
        } else {
            session()->flash('message', 'User not found!');
            session()->flash('class', 'warning');
            
            return redirect()->route('dashboard');
        }
    }
}
