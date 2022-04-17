<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        $posts = $user->posts()->with(['user', 'likes'])->paginate(3);
        $total = $user->posts()->count();
        /*  dd($user); */
        return view('users.posts.index', [
            'user' => $user,
            'posts' => $posts,
            'total' => $total
        ]);
    }
}
