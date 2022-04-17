<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('users.profile', ['user' => auth()->user()]);
    }

    public function change(Request $request)
    {
        $request = $request->merge(['name' => strip_tags($request->name)], ['username' => strip_tags($request->username)]);
        //update and validate user
        if ($request->name != auth()->user()->name) {
            $this->validate($request, ['name' => 'max:255|min:2']);
            User::where('id', auth()->user()->id)->update([
                'name' => $request->name
            ]);
        }
        if ($request->username != auth()->user()->username) {
            $this->validate($request, ['username' => 'unique:users,username|max:255|min:2'], ['username.unique' => 'This username has been taken, please choose another one']);
            User::where('id', auth()->user()->id)->update([
                'username' => $request->username
            ]);
        }
        if ($request->email != auth()->user()->email) {
            $this->validate($request, ['email' => 'unique:users,email|email|max:255|min:7']);
            User::where('id', auth()->user()->id)->update([
                'email' => $request->email
            ]);
        }

        return back()->with('status', 'User Profile has been Updated Successfully!');
    }
}
