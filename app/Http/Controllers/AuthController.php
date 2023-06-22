<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // cek apakah email dan password sesuai
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // jika yang login adalah user dengan role User (id = 3)
            if (Auth::user()->role == 3) {
                return redirect()->intended('/shop');
            } elseif (Auth::user()->role == 2) {
                return redirect()->intended('/sliders');
            }

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->withInput($request->only('email'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        return view('register');
    }

    public function processRegister(Request $request)
    {
        //validate form
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|max:100',
        ]);

        User::create([
            'avatar' => 'default-avatar3.jpg',
            'name' => $request->name,
            'role' => 3,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        //redirect to index
        return redirect()->route('register')->with(['success' => 'Registrasi berhasil!']);
    }
}
