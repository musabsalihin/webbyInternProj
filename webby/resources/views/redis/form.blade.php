<x-app-layout>
    <form method="post" action="{{route('redis.add')}}">
        @csrf
        @method('post')
        <label for="key">Insert a key</label>
        <input type="text" name="key" id="key"><br>
        <label for="content">Content</label>
        <input type="text" name="content" id="content">
        <input type="submit" value="Add Key">
    </form>
</x-app-layout>