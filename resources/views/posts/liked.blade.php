@extends('layouts.app')
@section('title', 'Liked Posts')
@section('content')
<div class="flex justify-center items-center flex-col">
    <div class="w-10/12 lg:w-8/12 bg-white rounded-lg p-6 text-center">
        <p class="mb-4 mt-2 border-t-2 border-gray-300">Posts liked by You <br> starting from recently liked</p>
        @auth
        @if($likes->count())
        @foreach($likes as $like)
        <p class="mt-2 text-left">Liked by you {{$like->updated_at->diffForHumans()}}</p>
        @foreach($posts as $post)
        @if($post->id == $like->post_id)
        <x-post :post="$post" />
        @endif
        @endforeach
        @endforeach
        <div class="my-4">{{$likes->links()}}</div>
        @elseif(!$likes->count() && !($likes->onFirstPage()))
        <p class="mt-2">There are no posts that you liked on this page</p>
        <button class="mt-4 w-full md:w-1/4 text-white p-2 rounded bg-indigo-500 hover:bg-indigo-800 font-semibold">
            <a href="{{$likes->previousPageUrl()}}">previous page</a></button>
        @else
        <p class="mt-2">There are no posts yet {{$likes->onFirstPage()}}</p>
        @endif
        @endauth
    </div>

</div>
@endsection