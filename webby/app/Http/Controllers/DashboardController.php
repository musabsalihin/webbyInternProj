<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function summary(){
        $total = User::all()->count();
        $verified = User::where('email_verified_at','!=',null)->get()->count();
        $unverified = $total - $verified;

        $total_post = Post::all()->count();
        $published_post = Post::where('status','=','Published')->get()->count();
        $draft_post = $total_post - $published_post;

        $data = [
            'total'=> $total,
            'verified'=>$verified,
            'unverified' => $unverified,
            'total_post'=>$total_post,
            'published_post' => $published_post,
            'draft_post' => $draft_post,
        ];
        // dd($data);
        return view('dashboard',['data'=>$data]);
    }

    public function show(){
        $users = User::all();
        return view('dashboard.users', ['users' => $users]);
    }

    public function create(){
        return view('dashboard.add');
        
    }

    public function add(Request $request){
        $request['password']='12345678';
        // dd($request);
        $data = $request -> validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        $newUser->sendEmailVerificationNotification();

        //send email verification and create new password

        return redirect(route('users.show'));
    }

    //edit user
    public function edit(User $user){
        // dd($user);
        return view('dashboard.view', ['user'=>$user]);
    }
    //update user
    public function update(User $user, Request $request){
        $data = $request -> validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        return redirect(route('users.show'));
    }

    //delete user
    public function delete(User $user){
        $user->delete();

        return redirect(route('users.show'));
    }
}
