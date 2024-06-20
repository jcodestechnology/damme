<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user_role'=> 'required',
            'password' => 'required|string|min:8',
            'user_role'=> 'required',
        ]);

        // Create a new user instance
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_role =$request->user_role;
        

        // Save the user
        $user->save();

        // Redirect back with a success message
        return back()->with('success', 'Registration successful.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Authentication was successful
            return $this->redirectBasedOnRole();
        }

        // Authentication failed
        return back()->withErrors([
            'emailPassword' => 'The provided credentials do not match our records.'
        ]);
    }

    protected function redirectBasedOnRole()
    {
        $user = Auth::user();
        
        // Check user role and redirect accordingly
        if ($user->user_role === 'client') {
            return redirect()->route('dashboard_member');
        } else {
            return redirect()->route('dashboard_page');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // log the user out of our application
        $request->session()->invalidate(); // invalidate the session
        $request->session()->regenerateToken(); // regenerate the CSRF token

        return redirect('login'); // redirect to homepage or your desired location
    }
}

