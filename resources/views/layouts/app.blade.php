<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>
        <meta name="description" content="{{ $description ?? config('app.description') }}">

        <link rel="icon" href="{{ asset('/storage/assets/favicon.ico') }}" type="image/x-icon">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        @if (app()->isProduction())
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-995JKQH73W"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-995JKQH73W');
            </script>
         @endif
    </head>
    <body class="antialiased font-sans">
        <x-header :title="$headerTitle ?? null" />
        <main>
            {{ $slot }}
        </main>
        <x-footer />
    </body>
</html>
