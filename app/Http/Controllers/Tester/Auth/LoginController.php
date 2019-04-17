<?php

namespace App\Http\Controllers\Tester\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        Auth::guard('tester');
        if ( Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/home');
        }
        return view('auth.login')->withErrors(['email', trans('auth.failed')]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}