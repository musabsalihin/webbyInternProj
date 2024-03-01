<x-app-layout>
    <!-- <script type="text/javascript" src="node_modules/froala-editor/js/froala_editor.pkgd.min.js"></script> -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
    </x-slot>
    <x-validation-errors class="mb-4" />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <form method="post" action="{{route('post.update',['post'=>$post])}}">
            @csrf
            @method('put')
            <div>
                <label for="title">Title</label>
                <input id="title" name="title" type="text" value="{{$post->title}}">
            </div>
            <div>
                <label for="publish_date">Publish Date</label>
                <input id="publish_date" name="publish_date" type="date" min="{{now('Asia/Singapore')->format('Y-m-d')}}" value="{{$post->publish_date->format('Y-m-d')}}">
            </div>
            <div>
                <label for="description">Description</label>
                <textarea cols="30" rows="10" id="editor" name="description" >{{$post->description}}</textarea>
            </div>
            <div>
                <input type="submit" name="action" value="Save and Publish Post">
                <input type="submit" name="action" value="Save as Draft">
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