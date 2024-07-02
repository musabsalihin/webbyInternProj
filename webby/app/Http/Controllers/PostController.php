<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //show all posts
    public function index(){
        $posts = $this->fetch_all_posts();

        return view('post.index', ['posts' => $posts]);
    }

    public function fetch_all_posts(){
        return Post::all();
    }

    public function show(){

        $data = $this->fetch_published_post();

//         dd($data);
        return view('welcome', ['posts' => $data]);
    }

    public function fetch_published_post(){
        $now = date('Y-m-d');
        return Post::where([
            ['status','=','Published'],
            ['publish_date','<=',$now],
        ])->get();
    }

    public function read(Post $post){
        return view('post.read',['post' => $post]);
    }

    //view one post

    //create a new post
    public function create(){
        return view('post.add');
    }

    //add post to db
    public function add(Request $request){
        // dd($request);
        $current_date = date('Y-m-d');
        if($request['action'] == "Create Post"){
            $request['status'] = 'Published';
        }
        else{
            $request['status'] = 'Draft';
        }

        $data = $request -> validate([
            'title' => 'required|string|unique:posts|max:255',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'publish_date' => 'required|after_or_equal:'.$current_date,
            'status' => 'required'
        ]);


        $newPost = Post::create($data);

        if($request->has('image')){
            $img = $newPost->addMedia($request->image)->toMediaCollection('bg-posts');
            $path = $img->getUrl();
            // dd($path);
            $newPost->update([
                'image'=>$path,
            ]);
        }
        // dd($newPost);
        // dd($data['image']);
        return redirect(route('post.index'));
    }


    //edit post
    public function edit(Post $post){
        // dd($post);
        return view('post.edit',['post' => $post]);
    }

    //update changes to database
    public function update(Post $post,Request $request){
        $current_date = date('Y-m-d');

        $data = $request->validate([
            'title'=> 'required|max:255',
            'description' => 'required',
            'publish_date' =>'required|after_or_equal:'.$current_date,
        ]);

        if($request['action'] == "Save and Publish Post"){
            $data['status'] = 'Published';
        }
        else{
            $data['status'] = 'Draft';
        }

        $post->update($data);

        return redirect(route('post.index'));
    }

    //delete post
    public function delete(Post $post){
        $post->delete();

        return redirect(route('post.index'));
    }
}
