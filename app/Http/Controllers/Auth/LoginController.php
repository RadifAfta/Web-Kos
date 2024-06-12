<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['role' => 'user']))) {
            return redirect()->intended(route('home'));
        } elseif (Auth::attempt(array_merge($credentials, ['role' => 'owner']))) {
            return redirect()->intended(route('owner.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        $role = Auth::user()->role;

        Auth::logout();

        if ($role === 'owner') {
            return redirect()->route('login');
        }

        return redirect()->route('login');
    }
}
