<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $request = $request->merge(['name' => strip_tags($request->name)], ['username' => strip_tags($request->username)]);
        $this->validate($request, ['name' => 'required|max:255|min:2', 'username' => 'required|unique:users,username|max:255|min:2', 'email' => 'required|unique:users,email|email|max:255|min:7', 'password' => 'required|min:3|confirmed'], ['email.unique' => 'This email exists, try to login', 'username.unique' => 'This username has been taken, please choose another one']);
        //create and validate user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username
        ]);

        //now we want to stay signed in
        $credentials = $request->only(['email', 'password']);
        Auth::attempt($credentials, $remember = true);
        return redirect()->route('dashboard');

        /* auth()->attempt($request->only('email', 'password'));
            auth()->user();  this won't work
            use what is above or:
            if(Auth::attempt($credentials)){
                Auth::login($user);
                or even
                Auth::login($user, $remember = true);
                and redirect to dashboard where auth()->user() knows too abot the user...
            }*/


        /* dd('store'); */

        /* dd($request->email); */
    }
}
