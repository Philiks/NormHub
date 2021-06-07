<?php

namespace App\Http\Controllers;

use App\Facades\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->where('is_admin', '=', false);

        return view('user.users')->with('users', $users);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {   
        return view('user.profile')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('user.profile-edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fullname' => 'string|max:255',
            'username' => 'string|max:255',
            'email' => 'string|email|max:255',
            'photo' => 'image|mimes:jpg,jpeg,bmp,png|max:5120',
        ]);

        $user->update([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        if ($request->has('password'))
            $user->update(['password' => Hash::make($request->password)]);

        if ($request->has('photo') && 
            $request->file('photo')->getClientOriginalName() != explode('/', $user->profile_photo)[2]) // [0]profiles [1]id [2]name
            Photo::store($request->file('photo'), $user, 'profiles');

        return redirect()->route('user.show', $user->id);
    }
}
