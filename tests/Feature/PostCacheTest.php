<?php

use App\Blog\Contracts\PostServiceInterface;

beforeEach(function () {
    config(['cache.default' => 'file']);
    app(PostServiceInterface::class)->clearCache();
});

afterEach(function () {
    app(PostServiceInterface::class)->clearCache();
});

it('serves the blog index from a serializing cache store', function () {
    $this->get('/posts')->assertOk();
    $this->get('/posts')->assertOk();
});

it('serves each blog post from a serializing cache store', function () {
    $posts = app(PostServiceInterface::class)->all();

    expect($posts)->not->toBeEmpty();

    foreach ($posts as $post) {
        $this->get("/posts/{$post->slug}")->assertOk();
        $this->get("/posts/{$post->slug}")->assertOk();
    }
});
