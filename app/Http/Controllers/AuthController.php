<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function proses_login(Request $request)
    {
        if ($request->remember === null) {
            setcookie('username', $request->username, 100);
            setcookie('password', $request->password, 100);
        } else {
            // dd('ok');
            setcookie('username', $request->username, time() + 60 * 60 * 24 * 100);
            setcookie('password', $request->password, time() + 60 * 60 * 24 * 100);
        }
        // dd(auth()->user()->role);


        if (Auth::attempt(['username' => $request->username, 'password' => $request->password]) ) {

            return redirect(route(auth()->user()->role . '_dashboard'))->with('pesan', 'Selamat datang kembali "' . auth()->user()->name . '"');
        } else {
            return redirect('/')->with('gagal', 'Periksa Username dan Password anda');
        }

        return redirect()->back();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
