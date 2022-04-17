@extends('layouts.app')
@section('title', 'Post')
@section('content')
<div class="flex justify-center">
    <div class="w-10/12 lg:w-8/12 bg-white rounded-lg p-6 text-center">
        <x-post :post="$post" />
    </div>
</div>
@endsection