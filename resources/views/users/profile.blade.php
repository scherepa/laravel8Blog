@extends('layouts.app')
@section('title', ucfirst(auth()->user()->name))
@section('content')
<div class="flex justify-center">
    <div class="w-10/12 md:w-6/12 lg:w-4/12 bg-white rounded-lg p-6 shadow-lg">
        @if (session('status'))
        <div class="bg-green-500 rounded text-white my-4 py-3 px-1 font-sm">
            {{ session('status') }}
        </div>
        @endif
        <h1>Update Your Profile</h1>
        <form action="{{ route('users.update')}}" method="POST" autocomplete="off" class="mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="sr-only">Name</label>
                <input type="text" name="name" id="name" placeholder="Your name" class="bg-gray-100 w-full border-2 rounded-lg p-4" value="{{auth()->user()->name}}">
                @error('name')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="username" class="sr-only">User Name</label>
                <input type="text" name="username" id="username" placeholder="User name" class="bg-gray-100 w-full border-2 rounded-lg p-4" value="{{auth()->user()->username}}">
                @error('username')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" placeholder="example@walla.com" class="bg-gray-100 w-full border-2 rounded-lg p-4" value="{{auth()->user()->email}}">
                @error('email')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-green-400 w-full rounded font-semibold text-white px-3 py-4 focus:ring-4 focus:ring-green-300 focus:ring-opacity-50 hover:bg-green-600 transition ease-in-out duration-700 shadow-lg ">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection