@props(['project', 'index'])

@php
    $border_color = match ($index % 5) {
        0 => 'border-amber-400',
        1 => 'border-orange-700',
        2 => 'border-red-700',
        3 => 'border-pink-900',
        4 => 'border-purple-900',
    };

    $bg_button_color = match ($index % 5) {
        0 => 'bg-amber-400/90',
        1 => 'bg-orange-700/90',
        2 => 'bg-red-700/90',
        3 => 'bg-pink-900/90',
        4 => 'bg-purple-900/90',
    };

    $bg_opacity_color = match ($index % 5) {
        0 => 'bg-amber-400/15',
        1 => 'bg-orange-700/15',
        2 => 'bg-red-700/15',
        3 => 'bg-pink-900/15',
        4 => 'bg-purple-900/15',
    };

    $text_color = match ($index % 5) {
        0 => 'text-amber-400',
        1 => 'text-orange-700',
        2 => 'text-red-700',
        3 => 'text-pink-900',
        4 => 'text-purple-900',
    };

    $text_color_hover = match ($index % 5) {
        0 => 'group-hover:text-amber-400',
        1 => 'group-hover:text-orange-700',
        2 => 'group-hover:text-red-700',
        3 => 'group-hover:text-pink-900',
        4 => 'group-hover:text-purple-900',
    };

    $shadow_color = match ($index % 5) {
        0 => 'shadow-amber-400',
        1 => 'shadow-orange-700',
        2 => 'shadow-red-700',
        3 => 'shadow-pink-900',
        4 => 'shadow-purple-900',
    };
@endphp

<a class="border-4 border-black shadow-square {{ $shadow_color }}" href="{{ $project->url }}" target="_blank">
    <div class="grid grid-cols-1 group lg:grid-cols-[48%_1fr] {{ $bg_opacity_color }}">
        <img
            class="aspect-square border-b-4 border-black h-full object-cover w-full lg:aspect-video lg:border-b-0 lg:border-r-4"
            src="{{ $project->imageUrl() }}"
            alt="{{ $project->name }} screenshot"
            loading="lazy" />
        <div class="flex flex-col justify-center pb-20 px-6 pt-10 lg:px-14 relative">
            <div class="flex gap-4">
                @foreach ($project->roles as $roles)
                    <span class="font-medium border-b-2 border-black">{{ $roles }}</span>
                @endforeach
            </div>
            <h2 class="font-bold mt-5 text-4xl lg:text-5xl">{{ $project->name }}</h2>
            <p class="mt-2">{{ $project->description }}</p>
            {{-- <ul class="mt-4">
                @foreach ($project->details as $detail)
                    <li>{!! $detail !!}</li>
                @endforeach
            </ul> --}}
            <span class="absolute border-b-4 border-l-2 duration-300 font-medium px-8 py-2 right-0 text-white tracking-wider top-0 uppercase {{ $bg_button_color }} {{ $border_color }}">
                View
            </span>
            <svg class="absolute duration-300 pointer-events-none -right-10 rotate-45 -top-10 w-24 group-hover:-right-12 group-hover:-top-12 {{ $text_color_hover }}"
                fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path
                    d="M256 82.7l22.6 22.6 192 192L493.3 320 448 365.3l-22.6-22.6L256 173.3 86.6 342.6 64 365.3 18.7 320l22.6-22.6 192-192L256 82.7z" />
            </svg>
        </div>
    </div>
</a>
