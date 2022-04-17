<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy', 'edit']);
    }

    public function index()
    {
        /* $posts = Post::get(); */
        /* $posts = Post::cursorPaginate(2); */
        $posts = Post::orderBy('updated_at', 'desc')->with(['user', 'likes'])->paginate(2);
        /* or simply like this:
         $posts = Post::latest()->with(['user', 'likes'])->paginate(2); */
        return view('posts.index', [
            'posts' => $posts
        ]);
    }
    public function store(Request $request)
    {
        //if there are tags then there is a need of an additional trim to the build in trim
        //for example without additional trim
        //"          <h1>    fashion"
        //will be
        //"  fashion"
        //if it is just: "     <h1>fashion"
        //then it will be ok without additional trim:"fashion"
        $request = $request->merge(['body' => trim(strip_tags($request->body))]);

        $this->validate($request, [
            'body' => 'required'
        ]);

        /* 1. make sure that post.php has fillable body:
        protected $fillable = [
        'body'];*/
        /* 2. make sure that user.php has posts method:
        public function posts(){
        return $this->hasMany(Post::class);} */
        /*make sore that post model has:
            public function user()
            {
                return $this->belongsTo(User::class);
            }*/
        /* 3. make sure that in migrations for post table added:
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('body'); */
        /* or auth()->user()->posts()->create([...what to add]) 
        next: write this line like this:
        $request->user()->posts()->create([
            'body' => $request->body
        ]);
        or:*/

        $request->user()->posts()->create($request->only('body'));
        #go back to posts
        return back();
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function showEdit(Post $post)
    {
        return view('posts.showEdit', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        /*dd($post); 
        but there is a problem if someone enter this rout with id post he still delete it this is why one more check should be done
        if(!$post->user()->id == auth()->user()->id){
            dd('You are not authorized to delete this message!');
        }
        but there is abetter way to do so, create policy, in authservices define relation and write: remember that we don't have to send user here...*/
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }

    public function edit(Post $post, Request $request)
    {
        $this->authorize('delete', $post);
        $request = $request->merge(['body' => strip_tags($request->body)]);
        $this->validate($request, [
            'body' => 'required'
        ]);
        /*dd($post); 
        but there is a problem if someone enter this rout with id post he still delete it this is why one more check should be done
        if(!$post->user()->id == auth()->user()->id){
            dd('You are not authorized to delete this message!');
        }
        but there is abetter way to do so, create policy, in authservices define relation and write: remember that we don't have to send user here...*/
        $post->update(['body' => $request->body]);
        return back()->with('status', 'User Profile has been Updated Successfully!');
    }
}
