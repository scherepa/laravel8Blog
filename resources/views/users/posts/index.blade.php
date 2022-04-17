@extends('layouts.app')
@section('title', ucfirst($user->name))
@section('content')
<div class="flex justify-center">
    <div class="w-10/12 lg:w-8/12 bg-white rounded-lg p-6 text-center">
        <h1 class="text-xl font-bold">{{ucfirst($user->name)}}</h1>
        @if($posts->count())
        <p class="mb-4 mt-2">{{ucfirst($user->name)}} Posted: {{$total}} {{Str::plural('post', $posts->count())}} and received {{$user->receivedLikes->count()}} {{Str::plural('like', $user->receivedLikes->count())}}</p>
        <!-- iterate -->
        @foreach($posts as $post)
        <x-post :post="$post" />
        @endforeach

        {{ $posts->onEachSide(1)->links()}}
        @elseif(!$posts->count() && !($posts->onFirstPage()))
        <p class="mt-2">There are no posts on this page</p>
        <button class="w-full md:w-1/4 text-white p-2 rounded bg-indigo-500 hover:bg-indigo-800 font-semibold">
            <a href="{{$posts->previousPageUrl()}}">previous page</a></button>
        @else
        <p class="mt-2">There are no posts yet {{$posts->onFirstPage()}}</p>
        @endif

    </div>

    @endsection