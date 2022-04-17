<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .name {
            display: inline-block;
        }

        @media (max-width:600px) {
            .name {
                display: none;
            }
        }
    </style>
    <title>My Blog - @yield('title')</title>
</head>

<body class="bg-gray-200 w-screen min-h-full max-w-full md:font-serif font-sans">
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li class="p-1 md:p-3 text-purple-900 hover:text-purple-500 {{((url()->current()) == route('home')) ? 'ring-2 ring-purple-100 rounded': ''}}"><a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i><span class="name">Home</span> </a></li>
            <li class="p-1 md:p-3 text-purple-900 hover:text-purple-500 {{(request()->is('dashboard*')) ? 'ring-2 ring-purple-100 rounded': ''}}"><a href="{{route('dashboard')}}"><i class="fa fa-rss" aria-hidden="true"></i><span class="name">Dashboard</span></a></li>
            <li class="p-1 md:p-3 text-purple-900 hover:text-purple-500 {{(request()->is('posts')) ? 'ring-2 ring-purple-100 rounded': ''}}"><a href="{{route('posts')}}"><i class="fa fa-paper-plane" aria-hidden="true"></i><span class="name">Post</span></a></li>
        </ul>
        <ul class="flex items-center">
            @auth
            <li class="p-1 md:p-3"><a href="{{route('users.show', auth()->user())}}" class="bg-purple-500 text-white focus:ring-2 focus:ring-purple-700 focus:ring-opacity-50 hover:bg-purple-900 rounded p-1 md:p-3 transition ease-in-out duration-700"><span class="hidden md:inline-block pr-1">Welcome, {{ucfirst(auth()->user()->name)}}</span><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                </a></li>
            <li class="p-1 md:p-3">
                <form class="inline w-full" action="{{route('logout')}}" method="Post">
                    @csrf
                    <button type="submit" href="" class="focus:ring-2 focus:ring-red-600 focus:ring-opacity-50 p-1 md:p-3 bg-pink-500 hover:bg-pink-800 rounded text-white  ml-2 md:ml-3 lg:ml-4 transition ease-in-out duration-700"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
                </form>
            </li>
            @endauth
            @guest
            <li class="p-1 md:p-3 hover:bg-purple-800 focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 text-white rounded transition ease-in-out duration-700 {{((url()->current()) == route('register')) ? 'border-4 border-purple-100 rounded bg-purple-700': 'bg-purple-500'}}"><a href="{{route('register')}}"><i class="fa fa-user-plus" aria-hidden="true"></i><span class="name">Register</span></a></li>
            <li class="focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 p-1 md:p-3 text-white rounded hover:bg-green-700 ml-2 md:ml-3 lg:ml-4 transition ease-in-out duration-700 {{((url()->current()) == route('login')) ? 'border-4 border-purple-100 rounded bg-green-600': 'bg-green-400'}}"><a href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i><span class="name">Login</span></a></li>
            @endguest
        </ul>
    </nav>
    @yield('content')
</body>

</html>