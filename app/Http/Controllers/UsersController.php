<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin/user/index', compact('users'));
    }

    // public function edit($user_id)
    // {
    //     $user = User::find($user_id);
    //     if(!$user) {
    //         return redirect()->route('users.index'); // Change route name to 'users.index'
    //     }
    //     return view('users.edit', compact('user'));
    // }
    

    // public function update(Request $request, $user_id)
    // {
    //     $user = User::find($user_id);
    //     if(!$user) {
    //         return redirect()->route('admin/user/index');
    //     }

    //     // Update user details
    //     $user->username = $request->input('username');
    //     $user->full_name = $request->input('full_name');
    //     $user->email = $request->input('email');
    //     if ($request->filled('password')) {
    //         $user->password = bcrypt($request->input('password'));
    //     }
    //     $user->save();

    //     return redirect()->route('admin/user/index')->with('success', 'User updated successfully.');
    // }
}
