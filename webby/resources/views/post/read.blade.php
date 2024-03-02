<x-guest-layout>
    <div class="sm:fixed sm:top-0 sm:left-0 p-4 text-3xl m-2 text-center z-10">
        <a href="{{route('post.show')}}">WEBBY</a>
    </div> 
    <div class="mt-14 max-w-7xl mx-auto p-6 lg:p-8">
        <h1 class="my-1 text-4xl font-extrabold">{{$post->title}}</h1>
        <p class="text-gray-500">Publish Date: {{$post->publish_date->format('d M Y')}}</p>
        <div class="content my-2 border-solid border-2 p-4 rounded-lg">
            {!!$post->description!!}
        </div>
    </div<>
</x-guest-layout>