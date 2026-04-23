<?php

use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component
{
    #[Validate('required|string|max:100')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|max:2000')]
    public string $messageBody = '';

    public string $website = ''; // honeypot

    public bool $sent = false;

    public function submit(): void
    {
        $this->validate();

        if ($this->website !== '') {
            $this->sent = true;

            return;
        }

        Mail::to(config('contact.recipient'))->send(
            new ContactMessage(
                name: $this->name,
                email: $this->email,
                messageBody: $this->messageBody,
            ),
        );

        $this->sent = true;
    }

    public function reset_form(): void
    {
        $this->reset(['name', 'email', 'messageBody', 'website', 'sent']);
        $this->resetValidation();
    }
}; ?>

<div>
    <dialog id="contact-dialog" class="backdrop:bg-black/40 max-w-lg p-6 rounded shadow-lg w-11/12">
        @if ($sent)
            <div class="space-y-4">
                <h2 class="font-bold text-lg">thanks — message sent</h2>
                <p class="text-sm">I'll get back to you at <strong>{{ $email ?: 'your email' }}</strong>.</p>
                <div class="flex gap-2 justify-end">
                    <button
                        type="button"
                        class="bg-red-700 hover:bg-red-900 px-4 py-2 rounded text-white"
                        wire:click="reset_form"
                        onclick="this.closest('dialog').close()"
                    >
                        close
                    </button>
                </div>
            </div>
        @else
            <form wire:submit="submit" class="space-y-4">
                <h2 class="font-bold text-lg">contact</h2>

                <label class="block">
                    <span class="block mb-1 text-sm">name</span>
                    <input type="text" wire:model="name" class="border px-3 py-2 rounded w-full" />
                    @error('name') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                </label>

                <label class="block">
                    <span class="block mb-1 text-sm">email</span>
                    <input type="email" wire:model="email" class="border px-3 py-2 rounded w-full" />
                    @error('email') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                </label>

                <label class="block">
                    <span class="block mb-1 text-sm">message</span>
                    <textarea wire:model="messageBody" rows="5" class="border px-3 py-2 rounded w-full"></textarea>
                    @error('messageBody') <span class="text-red-700 text-sm">{{ $message }}</span> @enderror
                </label>

                {{-- honeypot: hidden from humans, bots fill it in --}}
                <label class="sr-only" aria-hidden="true">
                    website
                    <input type="text" wire:model="website" tabindex="-1" autocomplete="off" />
                </label>

                <div class="flex gap-2 justify-end">
                    <button
                        type="button"
                        class="hover:text-red-900 px-4 py-2"
                        wire:click="reset_form"
                        onclick="this.closest('dialog').close()"
                    >
                        cancel
                    </button>
                    <button
                        type="submit"
                        class="bg-red-700 hover:bg-red-900 px-4 py-2 rounded text-white"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove wire:target="submit">send</span>
                        <span wire:loading wire:target="submit">sending…</span>
                    </button>
                </div>
            </form>
        @endif
    </dialog>
</div>
