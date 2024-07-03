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
    $response->assertStatus(200)
        ->assertViewHas(
            [
            'posts'
            ]
        );
});

test('unauthenticated user cannot retrieve all posts', function () {

    $user = User::factory()->create();

    $response = $this->get(route('post.index'));
    $this->assertGuest();
    $user->delete();
    $response->assertRedirect(route('login'));
});

test('guest can view published post', function () {
    $response = $this->get(route('post.show'));

    $this->assertGuest();
    $response
        ->assertStatus(200)
        ->assertViewHas(
            [
                'posts'
            ]
    );
});

//test invalid input for creating new post
test('unauthenticated user cannot create a post', function () {

//    $user = User::factory()->create();
    $data = Post::factory()->make();

    $response = $this->post(route('post.add'), [
        'title' => $data->title,
        'description' => $data->description,
        'publish_date' => $data->publish_date,
        'action' => rand(0,1)?'Create Post':'Draft',
    ]);

    $this->assertGuest()->assertDatabaseMissing('posts', [
        'title' => $data->title,
    ]);
    $response->assertRedirect(route('login'));
});

test('new post can be created', function () {

    $user = User::factory()->create();
    $data = Post::factory()->make();

    $response = $this->actingAs($user)->post(route('post.add'), [
        'title' => $data->title,
        'description' => $data->description,
        'publish_date' => $data->publish_date,
        'action' => rand(0,1)?'Create Post':'Draft',
    ]);

    $response->assertValid()
        ->assertRedirect(route('post.index'));
    $this->assertDatabaseHas('posts', [
        'title' => $data->title,
    ]);
    $post = Post::firstWhere('title', $data->title);
    $post->delete();

});

test('no input for title; unable to create new post', function () {

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

test('no input for description; unable to create new post', function () {

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

test('no input for publish date; unable to create new post', function () {

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
        'title' => $data->title,
    ]);

    $user->delete();
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
        'title' => $data->title,
    ]);

    $user->delete();
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

test('unauthenticated user cannot update a post', function () {

//    $user = User::factory()->create();
    $post = Post::factory()->create();
    $new_post = convertToPostArray(Post::factory()->make());

    $response = $this
        ->put(route('post.update', $post), $new_post);

    $this->assertGuest()->assertDatabaseMissing('posts', [
        'title' => $new_post['title'],
    ]);
    $post->delete();
    $response->assertRedirect(route('login'));
});

test('unable to update publish date to date before current date of the day', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();
    $new_post = convertToPostArray(Post::factory()->make());
    $new_post['publish_date'] = fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d');
    $response = $this->actingAs($user)
        ->put(route('post.update', $post), $new_post);

    $user->delete();

    $response->assertInvalid([
        'publish_date',
    ]);
    $post->delete();
//    $response->assertRedirect('/post');
});

test('post can be deleted', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $this->assertModelExists($post);

    $response = $this->actingAs($user)
        ->delete(route('post.delete', $post));

    $user->delete();
    $this->assertModelMissing($post);
    $response->assertRedirect(route('post.index'));
});

test('unauthenticated user cannot delete a post', function () {

    $post = Post::factory()->create();

    $response = $this->delete(route('post.delete', $post));

    $this->assertGuest()->assertModelExists($post);
    $post->delete();
    $response->assertRedirect(route('login'));
});
