<x-app-layout>
    <div>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
        </x-slot>
        @include('dashboard.partials.list')
    </div>
</x-app-layout>