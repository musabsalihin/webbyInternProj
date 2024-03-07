<x-app-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
    </x-slot>
    <x-validation-errors class="mb-4" />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <form class="mt-4" method="post" action="{{route('post.update',['post'=>$post->slug])}}">
            @csrf
            @method('put')
            <div class="my-4">
                <label class="block text-xl font-bold" for="title">Title</label>
                <input class="w-full rounded-2xl border-gray-400" id="title" name="title" type="text" value="{{$post->title}}">
            </div>
            <div class="my-4">
                <label class="block text-xl font-bold" for="publish_date">Publish Date</label>
                <input class="rounded-2xl" id="publish_date" name="publish_date" type="date" min="{{now('Asia/Singapore')->format('Y-m-d')}}" value="{{$post->publish_date->format('Y-m-d')}}">
            </div>
            <div class="my-4">
                <label class="block text-xl font-bold" for="description">Description</label>
                <textarea cols="30" rows="10" id="editor" name="description" >{{$post->description}}</textarea>
            </div>
            <div class="flex justify-end">
                <input class="bg-gray-800 px-4 py-3 mx-4 rounded-lg text-white font-bold uppercase text-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2 transition ease-in-out duration-150"
                type="submit" name="action" value="Save as Draft">
                <input class="bg-blue-600 px-4 py-3 mx-4 rounded-lg text-white font-bold uppercase text-md mr-0 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2 transition ease-in-out duration-150" 
                type="submit" name="action" value="Save and Publish Post">
                <!-- <input type="submit" value="Save Changes"> -->
            </div>
        </form>
    </div>
        <script>
            ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
            </script>

</x-app-layout>