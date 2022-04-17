@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="flex justify-center">
    <div class="w-10/12 md:w-6/12 lg:w-4/12 bg-white rounded-lg p-6 shadow-lg">
        <h1 class="font-bold mb-2">Please Login:</h1>
        @if(session('status'))
        <!-- or session()->has('status') -->
        <div class="mb-4 bg-red-500 w-full rounded font-semibold text-white px-3 py-4 text-center">
            {{ session('status')}}
        </div>
        @endif
        <form action="{{ route('login')}}" method="POST" class="mb-4">
            @csrf
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
            <div>
                <button type="submit" class="bg-green-400 w-full rounded font-semibold text-white px-3 py-4 focus:ring-4 focus:ring-green-300 focus:ring-opacity-50 hover:bg-green-600 transition ease-in-out duration-700 shadow-lg ">Login</button>
            </div>
        </form>
        <div>
            <p>New User?</p>
            <button class="w-full p-4 hover:text-white text-blue-600 rounded font-semibold my-2 ring-4 ring-blue-100 text-white border-2 hover:border-4 border-blue-100 ring-opacity-50 hover:bg-blue-600 rounded transition ease-in-out duration-700 shadow-lg "><a href="{{route('register')}}" class="w-full">Register here</a></button>
        </div>
    </div>

    @endsection