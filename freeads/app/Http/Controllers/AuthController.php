<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{   
    public function login() {
        return view('auth.login');
    }
    
    public function authentificate(Request $request) {

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

    
        if (Auth::attempt($data)) {
            
            $request->session()->regenerate();
    
            $user = Auth::user();
    
            if (!$user->hasVerifiedEmail()) {
                return view('errors.email_not_verified');
            }
    
            return redirect()->route('ads.index');
        }
    
    
        return back()->withErrors([
            'email' => 'Identifiant ou mot de passe incorrect',
        ]);

    
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
    
}
