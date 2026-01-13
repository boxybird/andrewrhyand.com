<?php

use App\Blog\Contracts\PostServiceInterface;
use Livewire\Volt\Component;

new class extends Component {
    public function with(PostServiceInterface $postService): array
    {
        return [
            'posts' => $postService->all(),
        ];
    }
}; ?>
<x-slot name="headerTitle">
    Blog
</x-slot>

<div class="container max-w-3xl mx-auto px-6 py-24">
    <div class="space-y-8">
        @forelse ($posts as $post)
            <article class="border-b border-gray-200 pb-8">
                <h2 class="text-2xl font-semibold mb-2">
                    <a href="{{ $post->url() }}" class="hover:text-red-700">
                        {{ $post->title }}
                    </a>
                </h2>
                <time datetime="{{ $post->date->toDateString() }}" class="text-gray-500 text-sm">
                    {{ $post->date->format('F j, Y') }}
                </time>
                <p class="mt-3 text-gray-600">{{ $post->excerpt }}</p>
                <a href="{{ $post->url() }}" class="inline-block mt-4 text-red-700 hover:text-red-900">
                    Read more &rarr;
                </a>
            </article>
        @empty
            <p class="text-gray-500">No posts yet.</p>
        @endforelse
    </div>
</div>
