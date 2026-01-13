<?php

use App\Blog\Contracts\PostServiceInterface;
use Livewire\Volt\Component;
use Livewire\Attributes\Locked;

new class extends Component {
    #[Locked]
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function with(PostServiceInterface $postService): array
    {
        $post = $postService->findBySlug($this->slug);

        if (! $post) {
            abort(404);
        }

        return [
            'post' => $post,
        ];
    }
}; ?>
<x-slot name="headerTitle">
    Posts
</x-slot>

<div class="prose container max-w-3xl mx-auto px-6 py-24">
    <article>
        <time datetime="{{ $post->date->toDateString() }}" class="text-gray-500">
            {{ $post->date->format('F j, Y') }}
        </time>

        <div class="prose prose-lg max-w-none mt-12">
            {!! $post->content !!}
        </div>

        <footer class="mt-12 pt-8 border-t border-gray-200">
            <a href="{{ route('posts.index') }}" class="text-red-700 hover:text-red-900">
                &larr; Back to all posts
            </a>
        </footer>
    </article>
</div>
