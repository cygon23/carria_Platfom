<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public  function users()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.users.list', [
            'users' => $users
        ]);
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'designation' => 'required|string|min:5|max:50',
        ]);

        // If validation fails
        if ($validator->fails()) {
            session()->flash('error', 'consider length please.name minmum 5, moblie 10+,desgnation minmum 5');
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
}
