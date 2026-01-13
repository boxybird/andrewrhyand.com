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
                'name' => 'Decay',
                'slug' => 'decay',
                'url' => 'https://decay.andrewrhyand.com',
                'image' => 'decay.webp',
                'description' => 'A View Transition API demo.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    'Developed with HTMX for dynamic UI updates without page reloads',
                    'Powered by FlightPHP lightweight backend framework',
                    'Used SleekDB as a simple, NoSQL-style database',
                    'Designed for fast, responsive performance with minimal dependencies',
                ],
            ],
            [
                'name' => 'ASCII Fight Club',
                'slug' => 'ascii-fight-club',
                'url' => 'https://hx-sse.andrewrhyand.com',
                'image' => 'ascii-fightclub.webp',
                'description' => 'A real-time ASCII art rendering of the Fight Club trailer streamed with Server-Sent Events and HTMX.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    'Streams ASCII art frames in real time using Server-Sent Events',
                    'Movie trailer converted frame-by-frame into ASCII art',
                    'Integrated with HTMX for seamless live updates',
                    'Creates the effect of an animated trailer rendered entirely in text',
                ],
            ],
            [
                'name' => 'Big </Head> Comics',
                'slug' => 'big-head-comics',
                'url' => 'https://bigheadcomics.andrewrhyand.com',
                'image' => 'bigheadcomics.webp',
                'description' => 'A Meilisearch demo using Vector Embedding.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    '100k comics indexed using Meilisearch',
                    'Uses text-embedding-3-small model by OpenAI',
                ],
            ],
            [
                'name' => 'Burque Events',
                'slug' => 'burque-events',
                'url' => 'https://burque.events/',
                'image' => 'burqueevents.webp',
                'description' => 'A local events site built using Laravel, Livewire, and Tailwind CSS.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    'Aggregates events from a network of merchants using REST API',
                ],
            ],
            [
                'name' => 'Alibi.com',
                'slug' => 'alibi',
                'url' => 'https://alibi.com',
                'image' => 'alibi.webp',
                'description' => 'A local paper magazine turned digital.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    'Plays nicely with SEO plugins',
                    'Uses WordPress template hierarchy for routing',
                    'Powered by custom plugin: <a class="text-indigo-600 underline" href="https://github.com/boxybird/wordpress-inertia-plugin" target="_blank">GitHub Repo</a>',
                ],
            ],
            [
                'name' => 'Gobblygoop.io',
                'slug' => 'gobblygoop',
                'url' => 'https://gobblygoop.andrewrhyand.com/mdasilva/prompts',
                'image' => 'gobblygoop.webp',
                'description' => 'An AI image sharing app demo using Laravel, Livewire, and Tailwind CSS.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    'Plays nicely with SEO plugins',
                    'Uses WordPress template hierarchy for routing',
                    'Powered by custom plugin: <a class="text-indigo-600 underline" href="https://github.com/boxybird/wordpress-inertia-plugin" target="_blank">GitHub Repo</a>',
                ],
            ],
            [
                'name' => 'Movie Lister',
                'slug' => 'movie-lister',
                'url' => 'https://htmx.andrewrhyand.com',
                'image' => 'htmx-movie.webp',
                'description' => 'A movie lister demo built using HTMX, Leaf, and Tailwind CSS.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    'Plays nicely with SEO plugins',
                    'Uses WordPress template hierarchy for routing',
                    'Powered by custom plugin: <a class="text-indigo-600 underline" href="https://github.com/boxybird/wordpress-inertia-plugin" target="_blank">GitHub Repo</a>',
                ],
            ],
            [
                'name' => 'PopMule',
                'slug' => 'popmule',
                'url' => 'https://popmule.com',
                'image' => 'popmule.webp',
                'description' => 'A digital magazine built using WordPress, Vue, and Tailwind CSS.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    '100% accessibility compliant',
                    'Infinite post scrolling use REST API',
                    'Designed using Tailwind CSS framework',
                    'Built using my custom WordPress starter theme',
                    'Uses Vue JS components for real-time AJAX search',
                ],
            ],
            [
                'name' => 'Barcode Index',
                'slug' => 'barcode-index',
                'url' => 'https://barcodeindex.com',
                'image' => 'barcodeindex.webp',
                'description' => 'A free UPC code database offering access to product prices, images, UPC code validation. Built using Laravel and AlpineJS.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    'Built using Laravel framework',
                    'SEO optimized using Schema.org standards',
                    'AJAX micro-interactions, including price updates',
                    'Aggregates products from a network of merchants using REST API',
                ],
            ],
            [
                'name' => 'Morph',
                'slug' => 'morph',
                'url' => 'https://wp-morph.andrewrhyand.com/',
                'image' => 'morph.webp',
                'description' => 'A demo site for the Morph WordPress plugin powered by AlpineJS.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    'Animation using GSAP - GreenSock',
                    'Reads and extract color palette from image',
                ],
            ],
            [
                'name' => 'Squarepeg Butthole',
                'slug' => 'squarepeg-butthole',
                'url' => 'https://squarepegbutthole.com',
                'image' => 'squarepegbutthole.webp',
                'description' => 'A NFT landing page for the Squarepeg Butthole collection using Astro, Vue, and Tailwind CSS.',
                'roles' => ['Developer', 'Designer'],
                'details' => [
                    'Plays nicely with SEO plugins',
                    'Uses WordPress template hierarchy for routing',
                    'Powered by custom plugin: <a class="text-indigo-600 underline" href="https://github.com/boxybird/wordpress-inertia-plugin" target="_blank">GitHub Repo</a>',
                ],
            ],
            [
                'name' => 'Colorado Succeeds',
                'slug' => 'colorado-succeeds',
                'url' => 'https://coloradosucceeds.org/resources/',
                'image' => 'coloradosucceeds.webp',
                'description' => 'A WordPress filter form powered by HTMX and AlpineJS.',
                'roles' => ['Developer'],
                'details' => [
                    'Plays nicely with SEO plugins',
                    'Uses WordPress template hierarchy for routing',
                    'Powered by custom plugin: <a class="text-indigo-600 underline" href="https://github.com/boxybird/wordpress-inertia-plugin" target="_blank">GitHub Repo</a>',
                ],
            ],
            [
                'name' => 'Axiom',
                'slug' => 'axiom',
                'url' => 'https://aeg.design',
                'image' => 'axiom.webp',
                'description' => 'A client project built using WordPress, Vue, and Tailwind CSS.',
                'roles' => ['Developer'],
                'details' => [
                    'Plays nicely with SEO plugins',
                    'Uses WordPress template hierarchy for routing',
                    'Powered by custom plugin: <a class="text-indigo-600 underline" href="https://github.com/boxybird/wordpress-inertia-plugin" target="_blank">GitHub Repo</a>',
                ],
            ],
        ];

        foreach ($rows as $row) {
            Project::create($row);
        }
    }
}
