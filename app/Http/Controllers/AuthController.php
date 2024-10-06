<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


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


    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('profile')->with('success', 'Welcome back!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid email or password.']);
        }
    }


    public function profile()

    {
        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        return view('auth.profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'designation' => 'required|string|min:7|max:50',
        ]);

        // If validation fails
        if ($validator->fails()) {
            session()->flash('error', 'consider length please.');
            return redirect()->back()->withInput()->with('validationErrors', $validator->errors());
        }


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->designation = $request->designation;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function profileImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB Max
        ]);

        $user = Auth::user()->id;

        if ($request->hasFile('image')) {
            // Delete old image if exists and it's not the default
            if ($user->image && $user->image !== 'images/default_avatar.png') {
                $oldImagePath = str_replace('storage/', 'public/', $user->image);
                Storage::delete($oldImagePath);
            }

            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = 'storage/' . $path; // Update image path
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }




    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('warning', 'succefully loged out');
    }
}
