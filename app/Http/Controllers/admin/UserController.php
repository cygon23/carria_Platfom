<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public  function users()
    {
        $users = User::orderBy('created_at', 'DESC')
            ->where('is_delete', 0)
            ->paginate(5);
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

    public function deleteUser(Request $request)
    {
        // Find the user by ID from the request
        $user = DB::table('users')
            ->where('id', $request->id)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found or already deleted');
        }

        // Mark the user as deleted (set is_delete to 1)
        DB::table('users')
            ->where('id', $request->id)
            ->update(['is_delete' => 1]);

        return redirect(route('dashboard.users'))->with('success', 'User deleted successfully');
    }
}
