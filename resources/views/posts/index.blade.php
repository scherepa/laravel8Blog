@extends('layouts.app')
@section('title', 'Posts')
@section('content')
<div class="flex items-center justify-center">
    <div class="w-10/12 lg:w-8/12 bg-white rounded-lg p-6">
        <h1 class="font-bold mb-4">New Post</h1>
        @auth
        <form action="{{ route('posts')}}" method="POST" class="mb-4">
            <!-- protection with hidden token -->
            @csrf
            <div class="mb-4">
                <label for="body" class="sr-only">Your Post Here:</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 w-full border-2 rounded-lg p-4 @error('body') border-red-500 @enderror" placeholder="YOUR POST HERE"></textarea>
                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div>
                <button type="submit" class="font-semibold bg-indigo-500 hover:bg-indigo-800 w-full md:w-1/4 rounded font-medium text-white p-2">Publish</button>
            </div>
        </form>
        @endauth
        @if($posts->count())
        <!-- iterate -->
        @foreach($posts as $post)
        <x-post :post="$post" />
        @endforeach
        <div class="mt-8 text-xs md:text-base">{{ $posts->onEachSide(1)->links()}}</div>

        @elseif(!$posts->count() && !($posts->onFirstPage()))
        <p class="mt-2">There are no posts on this page</p>
        <button class="w-full md:w-1/4 text-white p-2 rounded bg-indigo-500 hover:bg-indigo-800 font-semibold">
            <a href="{{$posts->previousPageUrl()}}">previous page</a></button>
        @else
        <p class="mt-2">There are no posts yet {{$posts->onFirstPage()}}</p>
        @endif
    </div>
</div>
@endsection