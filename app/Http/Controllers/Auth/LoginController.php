<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|min:7', 'password' => 'required|min:3']);
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return back()->with('status', 'Invalid Login');
        } else {
            Auth::attempt($credentials, $remember = true);
            return redirect()->route('dashboard');
        }
    }
}
