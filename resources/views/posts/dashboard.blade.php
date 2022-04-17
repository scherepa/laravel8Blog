@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="flex justify-center flex-col items-center">
    <div class="w-10/12 lg:w-8/12 bg-white rounded-lg p-6 text-center mb-4">
        <h1 class="text-xl font-bold mb-4">Your Dashboard</h1>

        <p class="mb-4 mt-2 border-t-2 border-gray-300">About Likes for Your posts</p>
        <p class="text-left mb-4 mt-2">You've Posted: {{$total}} {{Str::plural('post', $total)}} and Received {{auth()->user()->receivedLikes->count()}} {{Str::plural('like', auth()->user()->receivedLikes->count())}}</p>
        <p class="mb-2 text-left">Maximum likes per your post: {{$max}}</p>
        @if($sorted)
        <p class="text-left mb-4">Your Latest Post with Maximum Likes is:</p>
        <div class="mb-4">
            <x-post :post="$sorted" />
        </div>
        @endif
        <p class="mb-4 mt-2 border-t-2 border-gray-300">Posts liked by You</p>
        @if($lar)
        <p class="mb-2 text-left">You've Liked: {{$lar}} {{Str::plural('post', $lar)}}</p>
        <a href="{{route('dashboard.liked')}}" class="my-2">
            <div class="md:w-6/12 lg:w-4/12 bg-purple-800 text-white rounded text-center p-1">
                View all liked by you posts
            </div>
        </a>
        @else
        <p class="mb-2 text-left">You have not liked any posts yet...</p>
        @endif
        <p class="mb-4 mt-2 border-t-2 border-gray-300">All Your Posts</p>
        @if($total > 0)
        <p class="text-left mb-4 mt-2">You've Posted: {{$total}} {{Str::plural('post', $total)}}</p>
        <a href="{{route('users.posts', auth()->user())}}" class="my-2">
            <div class="md:w-6/12 lg:w-4/12 bg-purple-800 text-white rounded text-center p-1">
                View all your posts
            </div>
        </a>
        @else
        <p class="mt-2 text-left">You have no posts yet</p>
        @endif


    </div>
</div>

@endsection