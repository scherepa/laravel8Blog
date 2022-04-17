<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    public function allposts()
    {
        $all = Post::orderBy('updated_at', 'desc')->with(['user', 'likes'])->get();
        return $all;
    }

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function lastupd(Object $all_posts)
    {
        /* $nar = $obj->user()->posts()->orderBy('updated_at', 'desc')->with(['user', 'likes'])->pluck('id'); */
        $max = 0;
        $len = count($all_posts);
        $mid = 0;
        foreach ($all_posts as $item) {
            $a = Like::where('post_id', '=', $item)->count();
            $prev = $max;
            $max = $a > $max ? $a : $max;
            $mid = $max != $prev ? $item : $mid;
        }
        return [Post::find($mid), $max, $len];
    }


    public function index(Request $request)
    {
        $all_user_posts = $request->user()->posts()->orderBy('updated_at', 'desc')->with(['user', 'likes'])->pluck('id');
        $temp1 = $this->lastupd($all_user_posts);
        $sorted = $temp1[0];
        $total = $temp1[2];

        //as we're doing pagination, count() will be bound to results by pages
        //this is not what we want and that is why we need one more variable...
        //to find max we'll use total otherwise on each page it'll differ
        $lar = $request->user()->likes()->count();
        return view(
            "posts.dashboard",
            [
                'max' => $temp1[1],
                'sorted' => $sorted,
                'lar' => $lar,
                'total' => $total
            ]
        );
    }
    public function show(Request $request)
    {
        $posts = $this->allposts();
        $likes = $request->user()->likes()->orderBy('updated_at', 'desc')->paginate(3);
        //$likes = Like::orderBy('updated_at', 'desc')->where('user_id', '=', $request->user()->id)->paginate(3);
        return view(
            "posts.liked",
            [
                'posts' => $posts,
                'likes' => $likes
            ]
        );
    }
}
