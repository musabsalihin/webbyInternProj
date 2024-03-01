<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit User ') }}{{$user->name}}
        </x-slot>
        <x-validation-errors class="mb-4" />
        <form method="post" action="{{route('users.update',['user'=>$user])}}">
            @csrf
            @method('put')
            <div>
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{$user->name}}">
            </div>
            <div>
                <label for="email">Email</label>
                <input id="email" name="email" type="text" value="{{$user->email}}">
            </div>
            <div>
                <input type="submit" value="Update User">
            </div>
        </form>
</x-app-layout>