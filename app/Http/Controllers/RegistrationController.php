<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['string', 'required', 'max:255'],
            'email' => ['string', 'required', 'email'],
            'password' => ['string', 'required', 'confirmed', Password::min(8)]
        ]);

        User::create($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back();
    }
}
