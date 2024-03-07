<x-app-layout>
    <div>

        <x-slot name="header">
            <div class="flex justify-between sticky">
            <h2 class="inline-flex font-semibold items-center text-3xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a class="items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" 
            href="{{route('users.remind')}}">Send Reminder Email</a>
            <a class="items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" 
            href="{{route('users.create')}}">Add new user</a>
        </div>
        </x-slot>
        @include('dashboard.partials.list')
    </div>
</x-app-layout>