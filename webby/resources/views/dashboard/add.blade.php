<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New User') }}
            </h2>
        </x-slot>
        <x-validation-errors class="mb-4" />
        <div class="flex justify-center max-w-7xl mx-auto mt-20 px-4 sm:px-6 lg:px-8">
            <form class="px-12 w-1/2 bg-white rounded-xl" method="post" action="{{route('users.add')}}">
                @csrf
                @method('post')
                <div class="block my-6">
                    <label class="block mb-1" for="name">Name</label>
                    <input class="w-full rounded-xl border-gray-400 focus:outline-none focus:border-blue-500" id="name" name="name" type="text">
                </div>
                <div class="block my-6">
                    <label class="block mb-1" for="email">Email</label>
                    <input class="w-full rounded-xl border-gray-400 focus:outline-none focus:border-blue-500" id="email" name="email" type="text">
                </div>
                <div class="flex justify-end my-6" >
                    <input class="items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" 
                    type="submit" value="Add User">
                </div>
            </form>
        </div>
</x-app-layout>