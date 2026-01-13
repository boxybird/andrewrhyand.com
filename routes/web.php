<?php

use Livewire\Volt\Volt;

Volt::route('/', 'home')->name('home');

Volt::route('/posts', 'posts.index')->name('posts.index');
Volt::route('/posts/{slug}', 'posts.show')->name('posts.show');
