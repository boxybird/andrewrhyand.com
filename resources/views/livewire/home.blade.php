<?php

use App\Models\Project;
use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'projects' => Project::all(),
        ];
    }
}; ?>

<div class="container gap-16 grid grid-cols-1 overflow-x-clip max-w-7xl mt-8 sm:px-6 md:px-24 md:mt-16">
    @foreach ($projects as $project)
        <x-project-card :project="$project" :index="$loop->index" />
    @endforeach
</div>
