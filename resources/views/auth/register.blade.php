@extends('layouts.app')
@section('title', 'Registration')
@section('content')
<div class="flex justify-center">
    <div class="w-10/12 md:w-6/12 lg:w-4/12 bg-white rounded-lg p-6 shadow-lg">
        <h1>Registration</h1>
        <form action="{{ route('register')}}" method="POST" autocomplete="off" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="name" class="sr-only">Name</label>
                <input type="text" name="name" id="name" placeholder="Your name" class="bg-gray-100 w-full border-2 rounded-lg p-4 @error('name') border-red-500 @enderror" value="{{old('name')}}">
                @error('name')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="username" class="sr-only">User Name</label>
                <input type="text" name="username" id="username" placeholder="User name" class="bg-gray-100 w-full border-2 rounded-lg p-4 @error('username') border-red-500 @enderror" value="{{old('username')}}">
                @error('username')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" placeholder="example@walla.com" class="bg-gray-100 w-full border-2 rounded-lg p-4 @error('email') border-red-500 @enderror" value="{{old('email')}}">
                @error('email')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="Choose a password" class="bg-gray-100 w-full border-2 rounded-lg p-4 @error('password') border-red-500 @enderror">
                @error('password')
                <div class="text-red-500 mt-2 text-white text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="sr-only">Repeat Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" class="bg-gray-100 w-full border-2 rounded-lg p-4 @error('password') border-red-500 @enderror">
            </div>
            <div>
                <button type="submit" class="bg-green-400 w-full rounded font-semibold text-white px-3 py-4 focus:ring-4 focus:ring-green-300 focus:ring-opacity-50 hover:bg-green-600 transition ease-in-out duration-700 shadow-lg ">Register</button>
            </div>
        </form>
        <div>
            <p>Already registered?</p>
            <button class="w-full p-4 hover:text-white text-blue-600 rounded font-semibold my-2 ring-4 shadow-lg ring-blue-100 text-white border-2 hover:border-4 border-blue-100 ring-opacity-50 hover:bg-blue-600 rounded transition ease-in-out duration-700"><a href="{{route('login')}}" class="w-full">Login here</a></button>
        </div>
    </div>
</div>
@endsection