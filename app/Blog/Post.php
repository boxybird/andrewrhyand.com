<?php

declare(strict_types=1);

namespace App\Blog;

use Carbon\CarbonImmutable;

final readonly class Post
{
    public function __construct(
        public string $slug,
        public string $title,
        public CarbonImmutable $date,
        public string $excerpt,
        public string $content,
    ) {}

    /**
     * @param  array{title: string, date: string, excerpt: string}  $frontmatter
     */
    public static function fromParsed(
        string $slug,
        array $frontmatter,
        string $htmlContent
    ): self {
        return new self(
            slug: $slug,
            title: $frontmatter['title'],
            date: CarbonImmutable::parse($frontmatter['date']),
            excerpt: $frontmatter['excerpt'],
            content: $htmlContent,
        );
    }

    public function url(): string
    {
        return route('posts.show', $this->slug);
    }
}
