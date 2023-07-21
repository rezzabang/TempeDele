<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user')->with('users',$users);
    }

    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $user = new User();
 
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
 
        $user->save();
 
        return back()->with('success', 'Registrasi Berhasil');
    }

    public function login()
    {
        return view('login');
    }
 
    public function loginPost(Request $request)
    {
        $credetials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credetials)) {
            return redirect('/')->with('success', 'Login Berhasil');
        }
 
        return back()->with('error', 'Username atau Password Salah');
    }
 
    public function logout()
    {
        Auth::logout();
 
        return redirect()->route('login');
    }
}
