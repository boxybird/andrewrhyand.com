<header class="tracking-wide">
    <nav class="gap-4 flex flex-wrap font-bold justify-between px-6 py-4">
        <div class="flex gap-2 items-center">
            <span class="bg-amber-400 h-4 rounded-full w-4" aria-hidden="true"></span>
            <a class="hover:text-red-900" href="{{ route('home') }}">andrew rhyand</a>
        </div>
        <div class="flex flex-wrap gap-4 text-red-700">
{{--            <a class="hover:text-red-900" href="{{ route('posts.index') }}">posts</a>--}}
            <a class="hover:text-red-900" href="{{ route('home') }}">projects</a>
            <a class="hover:text-red-900" href="{{ route('about') }}">about</a>
            <button
                type="button"
                class="hover:text-red-900"
                onclick="document.getElementById('contact-dialog').showModal()"
            >
                contact
            </button>
            <a class="hover:text-red-900" href="https://github.com/boxybird" target="_blank">github</a>
            <a class="hover:text-red-900" href="https://www.linkedin.com/in/andrew-rhyand/" target="_blank">linkedin</a>
        </div>
    </nav>
    <h1 class="container font-bold leading-none max-w-7xl mt-8 text-[clamp(3rem,1rem_+_9vw,9rem)] uppercase sm:mt-16 sm:px-6 md:mt-24 md:px-24">
        {{ $title }}
    </h1>
    <div aria-hidden="true">
        <div class="bg-amber-400 h-9 md:h-12"></div>
        <div class="bg-orange-700 h-9 md:h-12"></div>
        <div class="bg-red-700 h-9 md:h-12"></div>
        <div class="bg-pink-900 h-9 md:h-12"></div>
        <div class="bg-purple-900 h-9 md:h-12"></div>
    </div>
    <livewire:contact-dialog />
</header>
