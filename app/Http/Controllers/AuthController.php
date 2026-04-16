<?php

namespace App\Http\Controllers;

use App\Models\UniversityIds;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //

    public function showRegisterFrom()
    {
        return view('auth.register');
    }

    public function creatRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'university_id' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        // Check if university ID exists
        $university = UniversityIds::where('university_id', $request->university_id)->first();
        if (!$university) {
            return back()->withErrors(['university_id' => 'University ID is not registered in the system.']);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            // 'university_id' => $request->university_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        //Store user data in session
        Session::put('user_id', $user->id);
        Session::put('name', $user->name);
        Session::put('email', $user->email);
        Session::put('role', $user->role);
        Session::put('is_logged_in', true);




        return redirect()->route('home')->with('success', 'Registration successful and user logged in.');
    }


    public function showLoginFrom()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = User::where('email', $request->input('email'))->first();

        if ($email && Hash::check($request->input('password'), $email->password)) {

            //Store user data in session
            Session::put('user_id', $email->id);
            Session::put('name', $email->name);
            Session::put('email', $email->email);
            Session::put('role', $email->role);

            Session::put('is_logged_in', true);

            return redirect()->route('home')->with('success', 'Login successful.');
        } else {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect()->route('show-login')->with('success', 'Logged out successfully.');
    }
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
    public function showResetPasswordForm()
    {

        $user = User::find(Session::get('user_id'));
        $email = $user->email;
        return view('auth.reset-password', compact('email'));
    }
    public function resetPassword(Request $request) {
           // validation
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    // get user by email
    $user = User::where('email', $request->email)->first();

    // update password
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    if (Session::get('user_id') == $user->id) {
        Session::put('password_updated', true);
    }

    return redirect()->route('home')
        ->with('success', 'Password has been reset successfully. Please login.');
    }

    public function testtoshowuserdata()
    {
        $user = Auth::user();
        return response()->json('wecome user' . $user->name);
    }
}
