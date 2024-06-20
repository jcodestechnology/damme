<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{

    public function index()
    {    $isLoggin=false;
        return view('auth.login',compact("isLoggin"));
    }

    public function customLogin(Request $request)
    {
    //    $validator =  $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
   
    
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         return redirect()->intended('dashboard')
    //                     ->withSuccess('Signed in');
    //     }
    //     $validator['emailPassword'] = 'Email address or password is incorrect.';
    //     return redirect("login")->withErrors($validator);
            return redirect("dashboard")
                        ->withSuccess('Signed in');
    }



    public function registration()
    {
        $isLoggin=false;
        return view('auth.registration',compact("isLoggin"));;
    }

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password']
      ]);
    }

    public function dashboard()
    {
        // if(Auth::check()){
        //     return view('dashboard.home');
        // }
        $isLoggin=true;
  
        return view('dashboard.home',compact("isLoggin"));
    }

    public function signOut() {
        
        Auth::logout();
  
        return redirect('login')->withIsLoggin(false);
    }
}