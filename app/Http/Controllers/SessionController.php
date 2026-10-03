<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['string', 'required', 'email'],
            'password' => ['string', 'required'],
            'remember_me' => ['accepted', 'sometimes'],
        ]);


        $userData = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];
        $rememberMe = $credentials['remember_me'] ?? false;

        if (Auth::attempt($userData, $rememberMe)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back();
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
