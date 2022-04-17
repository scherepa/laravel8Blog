@extends('layouts.app')
@section('title', 'Post')
@section('content')
<div class="flex justify-center">
    <div class="w-10/12 lg:w-8/12 bg-white rounded-lg p-6 text-center">
        @auth
        @if(auth()->user()->id === $post->user_id)
        <form action="{{ route('posts.edit', $post)}}" method="POST" class="mb-4">
            <!-- protection with hidden token -->
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="body" class="sr-only">Your Post Here:</label>
                <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 w-full border-2 rounded-lg p-4 @error('body') border-red-500 @enderror">{{$post->body}}</textarea>
                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="flex justify-start">
                <button type="submit" class="font-semibold bg-indigo-500 hover:bg-indigo-800 w-full md:w-1/4 rounded font-medium text-white p-2">Save</button>
            </div>
        </form>
        @endif
        @if (session('status'))
        <div class="bg-green-500 rounded text-white my-4 py-3 px-1 font-sm">
            {{ session('status') }}
        </div>
        @endif
        @endauth
        <x-post :post="$post" />
    </div>
</div>
@endsection