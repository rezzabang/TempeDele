<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Rules\ReCaptcha;



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
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:25',
                Rule::unique('users')->ignore(auth()->id()),
            ],
        ], [
            'username.unique' => 'Username telah digunakan.',
        ]);

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
        $rules = [
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
            'recaptcha' => ['required', new Recaptcha($request->recaptcha)]
        ];

        $message = [
            'username.required' => 'Username harus di isi',
            'password.required' => 'Password harus di isi',
            'captcha.required' => 'Captcha harus di isi',
            'captcha.captcha' => 'Captcha tidak sesuai',
            'recaptcha.required' => 'Apakah anda BOT?',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

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

    public function edituser($id)
    {
        $users=User::findOrFail($id);
        return view('edituser')->with('users',$users);
    }

    public function updateuser(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'name' => 'string|max:255',
            'password' => 'nullable|string|min:8',
        ], [
            'username.unique' => 'Username telah digunakan.',
        ]);

        if ($request->filled('username')) {
            $user->username = $request->username;
        }
    
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect("/user");
    }    

    public function deleteuser($id) {
        $user = User::findOrFail($id);

        $user->delete();
        
        return back();
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }
    
}
