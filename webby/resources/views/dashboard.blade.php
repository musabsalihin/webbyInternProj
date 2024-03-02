<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 flex-row">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="h-72 ">
                    <h1  class="text-2xl m-4">
                    User Report
                    </h1>
                    <div class="flex flex-row justify-evenly ">
                        <h2 class="text-xl">Total users<span class="block text-center text-8xl mt-8">{{$data['total']}}</span></h2>
                        <h2 class="text-xl">Number of users(VERIFIED)<span class="block text-center text-8xl mt-8">{{$data['verified']}}</span></h2>
                        <h2 class="text-xl">Number of users(UNVERIFIED)<span class="block text-center text-8xl mt-8">{{$data['unverified']}}</span></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="h-72">
                    <h1 class="text-2xl m-4">Post Report</h1>
                    <div class="flex flex-row justify-evenly">
                        <h2 class="text-xl">Number of posts created<span class="block text-center text-8xl mt-8">{{$data['total_post']}}</span></h2>
                        <h2 class="text-xl">Number of posts(published)<span class="block text-center text-8xl mt-8">{{$data['published_post']}}</span></h2>
                        <h2 class="text-xl">Number of posts(in Draft)<span class="block text-center text-8xl mt-8">{{$data['draft_post']}}</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
