<?php

declare(strict_types=1);

namespace App\Blog;

use App\Blog\Contracts\PostServiceInterface;
use Illuminate\Contracts\Cache\Repository as CacheContract;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;

final class PostService implements PostServiceInterface
{
    private const CACHE_KEY_ALL = 'blog.posts.all';

    private const CACHE_KEY_POST = 'blog.posts.';

    private const CACHE_TTL = 60 * 60;

    private MarkdownConverter $converter;

    private string $postsPath;

    public function __construct(
        private readonly CacheContract $cache,
        private readonly Filesystem $files,
        ?string $postsPath = null,
    ) {
        $this->postsPath = $postsPath ?? base_path('content/posts');
        $this->converter = $this->createConverter();
    }

    public function all(): Collection
    {
        return $this->cache->remember(
            self::CACHE_KEY_ALL,
            self::CACHE_TTL,
            fn () => $this->loadAllPosts()
        );
    }

    public function findBySlug(string $slug): ?Post
    {
        return $this->cache->remember(
            self::CACHE_KEY_POST.$slug,
            self::CACHE_TTL,
            fn () => $this->loadPost($slug)
        );
    }

    public function clearCache(): void
    {
        $this->cache->forget(self::CACHE_KEY_ALL);

        $files = $this->files->glob("{$this->postsPath}/*.md");
        foreach ($files as $file) {
            $slug = $this->extractSlugFromFilename(basename($file));
            $this->cache->forget(self::CACHE_KEY_POST.$slug);
        }
    }

    private function loadAllPosts(): Collection
    {
        $files = $this->files->glob("{$this->postsPath}/*.md");

        return collect($files)
            ->map(fn (string $file) => $this->parseFile($file))
            ->filter()
            ->sortByDesc(fn (Post $post) => $post->date)
            ->values();
    }

    private function loadPost(string $slug): ?Post
    {
        $files = $this->files->glob("{$this->postsPath}/*-{$slug}.md");

        if (empty($files)) {
            return null;
        }

        return $this->parseFile($files[0]);
    }

    private function parseFile(string $filePath): ?Post
    {
        if (! $this->files->exists($filePath)) {
            return null;
        }

        $content = $this->files->get($filePath);
        $result = $this->converter->convert($content);

        if (! $result instanceof RenderedContentWithFrontMatter) {
            return null;
        }

        $frontmatter = $result->getFrontMatter();

        if (! is_array($frontmatter) || ! $this->validateFrontmatter($frontmatter)) {
            return null;
        }

        $slug = $this->extractSlugFromFilename(basename($filePath));

        return Post::fromParsed(
            slug: $slug,
            frontmatter: $frontmatter,
            htmlContent: $result->getContent(),
        );
    }

    private function extractSlugFromFilename(string $filename): string
    {
        $withoutExtension = pathinfo($filename, PATHINFO_FILENAME);

        return substr($withoutExtension, 11);
    }

    private function validateFrontmatter(array $frontmatter): bool
    {
        return isset($frontmatter['title'], $frontmatter['date'], $frontmatter['excerpt']);
    }

    private function createConverter(): MarkdownConverter
    {
        $environment = new Environment;
        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new GithubFlavoredMarkdownExtension);
        $environment->addExtension(new FrontMatterExtension);

        return new MarkdownConverter($environment);
    }
}
