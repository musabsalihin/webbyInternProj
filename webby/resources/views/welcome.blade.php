<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="min-h-screen antialiased">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="sm:fixed sm:top-0 sm:left-0 p-4 m-2 text-center z-10 text-3xl">
                <a href="{{route('post.show')}}">
                    Webby Group
                </a>    
            </div> 

            <div class="mt-0 lg:mt-16 ">
                <h1 class="text-3xl mb-5 text-center">Welcome to WEBBY Post!</h1>
                    @foreach($posts as $post)
                    <div class="border-solid border-2 rounded-2xl h-96 mb-8">
                        <div class="h-3/4 bg-gray-400 rounded-t-2xl">
                            <img src="" alt="image here" class="w-full h-full rounded-t-xl">
                        </div>
                        <div class="h-1/4 bg-gray-100 p-4 flex items-center justify-between rounded-b-2xl">
                            <a class="underline text-xl focus:text-blue-400"  href="{{route('post.read', ['post' => $post->slug])}}">
                                {{$post->title}}
                            </a>
                            <p class="text-lg text-gray-700">{{$post->publish_date->format('d M Y')}}</p>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </body>
</html>
