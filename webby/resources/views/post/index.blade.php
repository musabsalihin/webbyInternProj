<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between sticky">
            <h2 class="inline-flex font-semibold items-center text-3xl text-gray-800 leading-tight">
                {{ __('Posts') }}
            </h2>
            <a class="items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" 
            href="{{route('post.create')}}">Add new post</a>
        </div>
    </x-slot>
    <x-validation-errors class="mb-4" />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <table class="mt-4 w-full table-auto text-center overflow-x-scroll">
            <tr class="py-12 border bg-gray-200 border-gray-300 ">
                <th class="p-4">ID</th>
                <th class="text-left px-4">Title</th>
                <th class="px-4">Status</th>
                <th class="px-4">Publish Date</th>
                <th class="px-4"></th>
                <th class="px-4"></th>
            </tr>
            @foreach($posts as $post)
            <tr class="h-8 border-b border-gray-300">
                <td class="py-2 px-4">{{$post->id}}</td>
                <td class="text-left w-1/2 py-2 px-4">{{$post->title}}</td>
                <td class="px-4 py-2">{{$post->status}}</td>
                <td class="px-4 py-2">{{$post->publish_date->format('d-M-Y')}}</td>
                <td class="px-4 py-2">
                    <a class="w-full inline-flex items-center justify-center py-1 px-4 bg-blue-400 rounded-xl text-white font-semibold hover:cursor-pointer hover:bg-blue-500 focus:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2 transition ease-in-out duration-150" 
                     href="{{route('post.edit', ['post' => $post->slug])}}">Edit</a>
                    </td>
                <td class="px-4 py-2">
                    <form method="post" action="{{route('post.delete', ['post' => $post->slug])}}">
                        @csrf
                        @method('delete')
                        <input class="w-full py-1 px-2 bg-red-400 rounded-xl text-white font-semibold hover:cursor-pointer hover:bg-red-500 focus:bg-red-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2 transition ease-in-out duration-150"
                         type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    </x-app-layout>