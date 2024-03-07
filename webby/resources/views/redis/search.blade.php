<x-app-layout>

    <a href="{{route('redis.form')}}">Add new key</a>
    <form method="get" action="{{route('redis.show')}}">
        @csrf
        @method('get')
        <label for="key">Insert a key</label>
        <input type="text" name="key" id="key">
        <input type="submit" value="Search Key">
    </form>
</x-app-layout>