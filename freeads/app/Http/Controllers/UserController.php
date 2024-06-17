<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActivationMail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.unique' => 'Cet email est déjà associé à un compte utilisateur',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères',
            'password.confirmed' => 'Les mots de passe ne correspondent pas',
        ]);

        $token = Str::random(60);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'activation_token' => $token
        ]);

        $activationLink = route('activate.account', ['token' => $token]);

        Mail::to($user->email)->send(new AccountActivationMail($activationLink));

        return view('emails.info_email');
    }

    public function activateAccount($token) {

        $user = User::where('activation_token', $token)->first();

        $user->markEmailAsVerified();
        $user->email_verified_at = Carbon::now();
        $user->save();
        
        return view('emails.account_verify');
    }

  

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('ads')->find($id);

        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {      
        $user = User::find($id);

        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
   

        $user = $user = User::find($id);

        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8',
        ]);

    
        if (!empty($data['current_password'])) {
       
            if (!Hash::check($data['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'L\'ancien mot de passe est incorrect']);
            }
    
            if (!empty($data['new_password'])) {
                
                $user->password = Hash::make($data['new_password']);
            } else {
                
                return back()->withErrors(['new_password' => 'Veuillez saisir un nouveau mot de passe']);
            }
        } elseif (!empty($data['new_password'])) {

            return back()->withErrors(['current_password' => 'Veuillez saisir votre ancien mot de passe']);
        }

        if (!empty($data['name'])) {
            $user->name = $data['name'];
        }
        if (!empty($data['email'])) {
            $user->email = $data['email'];
        }

        $user->save();

        return view('user.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();
        return redirect()->route('index');
    }
}
