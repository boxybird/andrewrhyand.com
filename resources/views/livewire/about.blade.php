<?php

use Livewire\Volt\Component;

new class extends Component {}; ?>
<x-slot name="headerTitle">
    About
</x-slot>

<div class="container max-w-7xl mt-8 sm:px-6 md:px-24 md:mt-16">
    <div class="max-w-3xl space-y-6 text-lg leading-relaxed">
        <p class="text-xl">
            Hi, I'm Andrew. Senior full-stack engineer and business strategist, based here in Albuquerque, New Mexico. I've been writing software since 2010, and shipping production web applications professionally since 2021 when I joined <a class="font-semibold text-red-700 hover:text-red-900" href="https://thegeckoagency.com" target="_blank">The Gecko Agency</a>, a 10-person studio in Missoula, MT, where I work remotely.
        </p>

        <p>
            My work goes deep where the problem demands it: reverse-engineering undocumented legacy codebases, designing vector-search architectures, tuning production caching layers, bridging on-premise systems to modern stacks. I build across modern frameworks (Vue, Svelte, React, Astro, Laravel) with test-driven, convention-enforced practices. At Gecko I'm one of three senior engineers, and architectural recommendations during sales conversations are a real part of the role. The "Business Strategist" half of my title isn't decorative.
        </p>

        <p>
            Since late 2025, I've been a daily practitioner of agentic coding using tools like Claude Code and Codex. What's changed for me over those months isn't <em>what</em> I think about as an engineer (architecture, performance, the business domain, the actual humans using the software), but how much time I have to think about it well, instead of context-switching between strategy and line-by-line typing. Concrete patterns I rely on: custom MCP servers for structured agent context, and Playwright verification loops so agents check their own frontend changes before completion. I've developed working judgment for what to delegate to agents, where they drift, and where my own attention has to stay.
        </p>

        <p>
            Right now I'm exploring how that practice applies to messy, real-world data problems. Two recent independent projects sit at that intersection. Groundtruth unifies New Mexico's fragmented public water data (groundwater levels, well permits, water rights) into a single address-searchable interface. <a class="font-semibold text-red-700 hover:text-red-900" href="https://locicodex.com" target="_blank">Loci</a> is a mobile companion app that captures in-game moments and recalls them later by mood, topic, or partial memory using on-device vector embeddings. Same problem class as cloud-based semantic search, but local-first.
        </p>

        <p>
            If you'd like to get in touch, the contact button in the header opens a short form. I'm also on <a class="font-semibold text-red-700 hover:text-red-900" href="https://github.com/boxybird" target="_blank">GitHub</a> and <a class="font-semibold text-red-700 hover:text-red-900" href="https://www.linkedin.com/in/andrew-rhyand/" target="_blank">LinkedIn</a>, both linked up top.
        </p>
    </div>
</div>
