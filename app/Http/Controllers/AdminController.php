<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin/home');
        } else {
            return back()->withErrors(['message' => 'Invalid credentials']);
        }
    }

    public function index()
    {
        return view('admin.home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
