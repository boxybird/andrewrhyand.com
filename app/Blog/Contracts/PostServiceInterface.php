<?php

declare(strict_types=1);

namespace App\Blog\Contracts;

use App\Blog\Post;
use Illuminate\Support\Collection;

interface PostServiceInterface
{
    /**
     * @return Collection<int, Post>
     */
    public function all(): Collection;

    public function findBySlug(string $slug): ?Post;

    public function clearCache(): void;
}
