<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Users') }}
            </h2>
        </x-slot>
        <x-validation-errors class="mb-4" />
        <form method="post" action="{{route('users.add')}}">
            @csrf
            @method('post')
            <div>
                <label for="name">Name</label>
                <input id="name" name="name" type="text">
            </div>
            <div>
                <label for="email">Email</label>
                <input id="email" name="email" type="text">
            </div>
            <div>
                <input type="submit" value="Add User">
            </div>
        </form>
</x-app-layout>