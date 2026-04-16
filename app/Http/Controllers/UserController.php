<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {

        $user_id = Session::get('user_id');
        $user = User::find($user_id);

        // $user = User::where('id',Session::get('user_id'))->get();
        return view('user.update-profile', compact('user'));
    }

    public function StoreEditProfile(Request $request)
    {

        $user = User::find(Session::get('user_id'));

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        Session::put('name',$request->name);

        $user->update($request->only('name','email','phone'));


        return redirect()->route('home')->with('success', 'Updated Profile Successfully');
    }
}
