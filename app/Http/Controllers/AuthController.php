<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index(){
        if (Auth::check()){
            return redirect()->intended(route('main'));
        }
        return view('auth.login');
    }

    public function auth(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->intended('/');
        }
        Alert::error('Gagal', 'Email atau Password Salah!');
        return redirect()->intended('/login');
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect()->intended('/login');
    }

    public function registrasi(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'passwordua' => 'required'
        ]);
        if ($request->password != $request->passwordua) {
            dd('tidakbenar');
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('login');
    }

    public function indexRegistrasi()
    {
        if (Auth::check()){
            return redirect()->intended(route('main'));
        }

        return view('auth.registrasi');
    }
}
