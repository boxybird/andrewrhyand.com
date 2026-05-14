<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'name' => 'Movie Madness',
                'slug' => 'movie-madness',
                'url' => 'https://www.moviemadness.org/search/',
                'image' => 'movie-madness.webp',
                'description' => 'An AI-powered semantic search experience for an independent Portland video rental business with a 100,000+ title catalog.',
                'roles' => ['Developer'],
                'technologies' => ['Vector Embeddings', 'Meilisearch', 'HTMX'],
                'details' => [
                    'Vector-embedding search over a 100,000+ title catalog, enabling lookup by mood, theme, and partial recall rather than exact-match titles',
                    'Built as a standalone app embedded within an existing WordPress site',
                    'Now serves tens of thousands of searches per month in production',
                ],
            ],
            [
                'name' => 'Guild Cinema',
                'slug' => 'guild-cinema',
                'url' => 'https://guildcinema.andrewrhyand.com/',
                'image' => 'guild-cinema.webp',
                'description' => 'An end-to-end ticketing platform prototype designed for independent movie theaters.',
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['Astro', 'Svelte', 'Tailwind', 'DigitalOcean'],
                'details' => [
                    'Researched small-theater operational pain points (high checkout friction, expensive integrations, thin margins)',
                    'Designed the full UX from scratch using agentic AI design tools',
                    'Built end-to-end with agentic AI coding tools: round-up-to-donate checkout, pre-purchase concessions, rewards, gift cards, and private rental inquiries',
                ],
            ],
            [
                'name' => 'Groundtruth',
                'slug' => 'groundtruth',
                'url' => null,
                'image' => 'groundtruth.webp',
                'description' => "A consumer-facing platform unifying New Mexico's fragmented public water data into a single address-searchable interface.",
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['Laravel', 'PostgreSQL', 'PostGIS', 'React', 'Inertia.js'],
                'details' => [
                    'Data ingestion pipelines pulling from disparate state agency file systems, library archives, and legacy APIs',
                    'AI normalizes heterogeneous records into a unified schema, replacing what is otherwise a manual, labor-intensive process',
                    'PostGIS geospatial queries for address-based lookup and point-in-polygon checks against water rights boundaries',
                ],
            ],
            [
                'name' => 'Alibi.com',
                'slug' => 'alibi',
                'url' => 'https://alibi.com',
                'image' => 'alibi.webp',
                'description' => 'A pro bono modernization of a long-running Albuquerque alternative weekly publication.',
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['WordPress', 'PHP', 'MySQL', 'Custom PHP (legacy)'],
                'details' => [
                    'Reverse engineered an opaque, single-developer legacy PHP codebase with no framework or documentation',
                    'Extracted, normalized, and migrated decades of editorial content into WordPress with image attributions, captions, and bylines preserved',
                    'Designed and shipped the new site end-to-end after previous developers had attempted and abandoned the migration',
                ],
            ],
            [
                'name' => 'Big </Head> Comics',
                'slug' => 'big-head-comics',
                'url' => 'https://bigheadcomics.andrewrhyand.com',
                'image' => 'bigheadcomics.webp',
                'description' => 'A Meilisearch demo using vector embeddings over 100k comics.',
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['Meilisearch', 'Vector Embeddings', 'OpenAI'],
                'details' => [
                    '100k comics indexed using Meilisearch',
                    'Uses text-embedding-3-small model by OpenAI',
                ],
            ],
            [
                'name' => 'Barcode Index',
                'slug' => 'barcode-index',
                'url' => 'https://barcodeindex.com',
                'image' => 'barcodeindex.webp',
                'description' => 'A free UPC code database with product prices, images, and code validation.',
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['Laravel', 'AlpineJS', 'REST APIs'],
                'details' => [
                    'SEO optimized using Schema.org standards',
                    'AJAX micro-interactions, including price updates',
                    'Aggregates products from a network of merchants using REST API',
                ],
            ],
            [
                'name' => 'Burque Events',
                'slug' => 'burque-events',
                'url' => 'https://burque.events/',
                'image' => 'burqueevents.webp',
                'description' => 'A local Albuquerque events site that aggregates listings from a network of merchants.',
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['Laravel', 'Livewire', 'Tailwind', 'REST APIs'],
                'details' => [
                    'Aggregates events from a network of merchants via REST API',
                    'Real-time interactivity powered by Livewire',
                ],
            ],
            [
                'name' => 'Gobblygoop.io',
                'slug' => 'gobblygoop',
                'url' => 'https://gobblygoop.andrewrhyand.com/mdasilva/prompts',
                'image' => 'gobblygoop.webp',
                'description' => 'An AI image sharing app demo built around prompt-and-generation flows.',
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['Laravel', 'Livewire', 'Tailwind'],
                'details' => [
                    'Prompt-driven image sharing with per-user prompt galleries',
                    'Real-time interactions powered by Livewire',
                ],
            ],
            [
                'name' => 'Decay',
                'slug' => 'decay',
                'url' => 'https://decay.andrewrhyand.com',
                'image' => 'decay.webp',
                'description' => 'A View Transition API demo with minimal dependencies.',
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['HTMX', 'FlightPHP', 'SleekDB'],
                'details' => [
                    'Dynamic UI updates without full page reloads via HTMX',
                    'Powered by FlightPHP, a lightweight backend framework',
                    'SleekDB for simple NoSQL-style storage',
                ],
            ],
            [
                'name' => 'ASCII Fight Club',
                'slug' => 'ascii-fight-club',
                'url' => 'https://hx-sse.andrewrhyand.com',
                'image' => 'ascii-fightclub.webp',
                'description' => 'A real-time ASCII art rendering of the Fight Club trailer streamed with Server-Sent Events and HTMX.',
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['HTMX', 'Server-Sent Events', 'PHP'],
                'details' => [
                    'Streams ASCII art frames in real time using Server-Sent Events',
                    'Movie trailer converted frame-by-frame into ASCII art',
                    'Live updates integrated via HTMX',
                ],
            ],
            [
                'name' => 'Movie Lister',
                'slug' => 'movie-lister',
                'url' => 'https://htmx.andrewrhyand.com',
                'image' => 'htmx-movie.webp',
                'description' => 'A movie lister demo built using HTMX, Leaf, and Tailwind CSS.',
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['HTMX', 'Leaf', 'Tailwind'],
                'details' => [
                    'Built using Leaf, a lightweight PHP framework',
                    'Real-time list filtering powered by HTMX',
                ],
            ],
            [
                'name' => 'PopMule',
                'slug' => 'popmule',
                'url' => 'https://popmule.com',
                'image' => 'popmule.webp',
                'description' => 'A digital magazine built using WordPress, Vue, and Tailwind CSS.',
                'roles' => ['Developer', 'Designer'],
                'technologies' => ['WordPress', 'Vue', 'Tailwind', 'REST APIs'],
                'details' => [
                    '100% accessibility compliant',
                    'Infinite post scrolling powered by REST API',
                    'Vue components for real-time AJAX search',
                ],
            ],
        ];

        foreach ($rows as $row) {
            Project::create($row);
        }
    }
}
