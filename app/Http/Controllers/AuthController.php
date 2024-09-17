<?php

namespace App\Http\Controllers;

use Str;
use Mail;
use App\Models\User;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  static function create_user(Request $request){

    request()->validate([
        'email' => 'required|email|unique:users',
        'username' => 'required|min:4|unique:users',
        'password' => 'required|min:8',
    ]);

    $save = new User;
    $save->name  =trim($request->name);
    $save->email =trim($request->email);
    $save->password =Hash::make($request->password);
    $save->remember_token = Str::random(30);
    $save->user_type = trim($request->user_type);
    $save->save();

    //call mail function for email verification
    Mail::to($save->email)->send(new RegisterMail($save));

    return redirect('login')->with('success', "user registerd succssfully");
  }

  public function verify($token){
    $user = User::where('remember_token', '=', $token)->first();
    if(!empty($user)){
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->remember_token = Str::random(30);
        $user->save();

        return redirect('login')->with('success', "your account succssfully verified");

    }
    else{
        abort(404);
    }
  }

  public function auth_login(Request $request){
     $remeber = !empty($request->remeber) ? true : false;
     if(Auth::attempt(['email' => $request->email,'password' => $request->password],$remeber)){

     }
     else{
         return redirect()->back()->with('error','Please write the correct email and password');
     }
  }
    static  function login(){
        return view('auth.login');
    }

   static function register (){
        return view('auth.register');
    }

    static function forgot(){
       return view('auth.forgot');
    }
}
