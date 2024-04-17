<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin/user/index', compact('users'));
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
       
        if(!$user) {
            return redirect()->route('users.index'); // Change route name to 'users.index'
        }
        return view('admin/user/edit', compact('user'));
    }
    

    public function update(Request $request, $user_id)
    {
        //dd($request->all());
        $user = User::find($user_id);
        if(!$user) {
            return redirect()->route('admin/user/index');
        }

        // Update user details
        $user->username = $request->input('user_name');
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('user_email');
        if ($request->filled('user_password')) {
            $user->password = Hash::make($request->input('user_password')); 
        }

    
        $user->save();
        

        
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
}
