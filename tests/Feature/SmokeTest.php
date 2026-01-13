<?php

use App\Blog\Contracts\PostServiceInterface;

it('loads the home page', function () {
    $this->get('/')->assertOk();
});

it('loads the blog index', function () {
    $this->get('/posts')->assertOk();
});

it('loads each blog post', function () {
    $posts = app(PostServiceInterface::class)->all();

    foreach ($posts as $post) {
        $this->get("/posts/{$post->slug}")
            ->assertOk();
    }
});

it('returns 404 for non-existent post', function () {
    $this->get('/posts/this-post-does-not-exist')
        ->assertNotFound();
});
