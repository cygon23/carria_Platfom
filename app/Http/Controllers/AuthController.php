<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function processRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:20|confirmed',
            'password_confirmation' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $save = new User;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        // $save->password = Hash::make(trim($request->password));
        $save->password = Hash::make(trim($request->password));
        $save->save();

        return redirect('login')->with('success', 'your succefully createated an account');
    }

    public function login()
    {
        return view('auth.login');
    }


    public function auth_login(Request $request)
    {


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        } else {
            return redirect()->back()->withInput()->withErrors(['error' => 'Invalid username or password.']);
        }
    }
}
