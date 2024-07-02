<?php

use App\Models\Post;
use App\Models\User;

function convertToPostArray($post)
{
    return [
        'title' => $post->title,
        'description' => $post->description,
        'publish_date' => $post->publish_date,
        'status' => $post->status,
    ];
}

test('admin or editor can retrieve all posts', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('post.index'));
    $user->delete();
    $response
        ->assertStatus(200)
        ->assertViewHas(
            [
            'posts'
            ]
        );
});

test('guest can view published post', function () {
    $response = $this->get(route('post.show'));

    $response
        ->assertStatus(200)
        ->assertViewHas(
            [
                'posts'
            ]
    );
});

//test invalid input for creating new post
test('new post created', function () {

    $user = User::factory()->create();
    $data = Post::factory()->make();

    $response = $this->actingAs($user)->post(route('post.add'), [
        'title' => $data->title,
        'description' => $data->description,
        'publish_date' => $data->publish_date,
        'action' => rand(0,1)?'Create Post':'Draft',
    ]);

    $this->assertDatabaseHas('posts', [
        'title' => $data['title'],
    ]);
    $response->assertValid()
        ->assertRedirect(route('post.index'));
});
test('title is not defined; unable to create new post', function () {

    $user = User::factory()->create();
    $data = Post::factory()->make();

    $response = $this->actingAs($user)->post(route('post.add'), [
        'title' => '',
        'description' => $data->description,
        'publish_date' => $data->publish_date,
        'action' => rand(0,1)?'Create Post':'Draft',
    ]);

    $response->assertInvalid([
        'title',
    ]);
    $this->assertDatabaseMissing('posts', [
        'title' => $data['title'],
    ]);
});
test('description is not defined; unable to create new post', function () {

    $user = User::factory()->create();
    $data = Post::factory()->make();

    $response = $this->actingAs($user)->post(route('post.add'), [
        'title' => $data->title,
        'description' => '',
        'publish_date' => $data->publish_date,
        'action' => rand(0,1)?'Create Post':'Draft',
    ]);

    $response->assertInvalid([
        'description',
    ]);
    $this->assertDatabaseMissing('posts', [
        'title' => $data['title'],
    ]);
});

test('publish date is not defined; unable to create new post', function () {

    $user = User::factory()->create();
    $data = Post::factory()->make();

    $response = $this->actingAs($user)->post(route('post.add'), [
        'title' => $data->title,
        'description' => $data->description,
        'publish_date' => '',
        'action' => rand(0,1)?'Create Post':'Draft',
    ]);

    $response->assertInvalid([
        'publish_date',
    ]);
    $this->assertDatabaseMissing('posts', [
        'title' => $data['title'],
    ]);
});

test('unable to enter date before the current date', function () {

    $user = User::factory()->create();
    $data = Post::factory()->make();

    $response = $this->actingAs($user)->post(route('post.add'), [
        'title' => $data->title,
        'description' => $data->description,
        'publish_date' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
        'action' => rand(0,1)?'Create Post':'Draft',
    ]);

    $response->assertInvalid([
        'publish_date',
    ]);
    $this->assertDatabaseMissing('posts', [
        'title' => $data['title'],
    ]);
});

//use faker here to generate different data
//create factory for post
test('post can be updated', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();
    $new_post = convertToPostArray(Post::factory()->make());
    $response = $this->actingAs($user)
        ->put(route('post.update', $post), $new_post);

    $user->delete();

    $this->assertDatabaseHas('posts', [
        'title' => $new_post['title'],
    ]);
    $post->delete();
    $response->assertRedirect('/post');
});

test('post can be deleted', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $response = $this->actingAs($user)
        ->delete(route('post.delete', $post));

    $user->delete();
    $this->assertModelMissing($post);
    $response->assertRedirect('/post');
});

//check all route for unauthorized access
