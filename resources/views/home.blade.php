@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="flex justify-center">
    <div class="w-10/12 lg:w-8/12 bg-white rounded-lg p-6">
        <h1 class="font-bold font-xl mb-4">Wellcome to Laravel Blog</h1>
        <p>If you are a registered user you can post new posts, delete'em. Like and unlike posts, get mail (now it'is only in test options... no real mail attached yet for this site) when your post get new like and check on dashbord your progress.<br>If you're a guest you still can read posts.</p>
        <div class="mt-4 text-left h-2">Enjoy!!!</div>

    </div>

    @endsection