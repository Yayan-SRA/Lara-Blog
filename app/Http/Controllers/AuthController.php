<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            'title' => "Login",
            'active' => 'login'
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            'title' => "register",
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        // return request()->all();
        // $name = $request->input('name');
        // $username = $request->input('username');
        // $email = $request->input('email');
        // $password = $request->input('password');

        $validatedData = $request->validate([
            'name' => 'required|min:5|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            // cara lain penulisan dapat menggunakan array
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5', 'max:255'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        // cara lain kirim flash data dengan lngsng menggunakan with di redirect
        // $request->session()->flash('success', 'Resgistration successfull! Please login');

        return redirect('/login')->with('success', 'Resgistration successfull! Please login');
    }

    public function auth(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'max:255'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
