# Contact Form Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Replace the header's Twitter "connect" link with a button that opens a native `<dialog>` containing a basic name/email/message form. Submissions are emailed to the owner's personal Gmail via Laravel Mail + SMTP.

**Architecture:** Single Volt class-based component hosts a native HTML `<dialog>` element. The header button opens it via `showModal()` (no JS framework). A Laravel Mailable is sent synchronously on submit, using Gmail SMTP with an App Password in production and the `log` driver locally. A honeypot field blocks drive-by bots.

**Tech Stack:** Laravel 13, Livewire 4, Volt 1, Pest 4, Tailwind 3, Gmail SMTP.

**Relevant skills to activate as needed during implementation:**
- @volt-development (for the dialog component)
- @livewire-development (for component tests and form patterns)
- @laravel-best-practices (Mailable, config, env)
- @pest-testing (feature + Livewire tests)
- @tailwindcss-development (dialog + form styling)

**Reference design:** `docs/plans/2026-04-22-contact-form-design.md`

---

## Task 1: Scaffold config + env

**Goal:** Add the config file and env entries the rest of the plan depends on. No test — pure configuration.

**Files:**
- Create: `config/contact.php`
- Modify: `.env.example` (append Gmail SMTP vars + `CONTACT_RECIPIENT`)
- Modify: `.env` (same vars; keep `MAIL_MAILER=log` locally so dev doesn't send real mail)

**Step 1: Create `config/contact.php`**

```php
<?php

return [
    'recipient' => env('CONTACT_RECIPIENT'),
];
```

**Step 2: Append to `.env.example`** (bottom of file, after existing vars)

```
CONTACT_RECIPIENT=your-gmail@gmail.com
```

And update the `MAIL_*` block so it documents the Gmail SMTP values (leaving the example password blank):

```
MAIL_MAILER=log
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-gmail@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

**Step 3: Mirror the same keys into local `.env`**

Keep `MAIL_MAILER=log` locally. Set `CONTACT_RECIPIENT=andrew.rhyand@gmail.com` (or the user's personal Gmail — confirm with the user before writing the real address; if unsure, leave as `your-gmail@gmail.com` and ask). Leave `MAIL_PASSWORD=` empty locally since we're using the log driver.

**Step 4: Verify config loads**

Run: `php artisan config:show contact`
Expected: shows `recipient` with the value you set.

**Step 5: Commit**

```bash
git add config/contact.php .env.example
git commit -m "Add contact config + Gmail SMTP env scaffolding"
```

Note: `.env` is gitignored — do not stage it.

---

## Task 2: Write failing Mailable test

**Goal:** TDD the `ContactMessage` Mailable. Write the test first.

**Files:**
- Create: `tests/Feature/ContactMessageTest.php`

**Step 1: Write the test**

```php
<?php

use App\Mail\ContactMessage;

it('builds the mailable with subject, reply-to, and body data', function () {
    $mail = new ContactMessage(
        name: 'Ada Lovelace',
        email: 'ada@example.com',
        messageBody: 'Hello from the contact form.',
    );

    $mail->assertHasSubject('New contact form message from Ada Lovelace');
    $mail->assertHasReplyTo('ada@example.com');
    $mail->assertSeeInHtml('Ada Lovelace');
    $mail->assertSeeInHtml('ada@example.com');
    $mail->assertSeeInHtml('Hello from the contact form.');
});
```

**Step 2: Run the test to confirm it fails**

Run: `php artisan test --compact --filter=ContactMessageTest`
Expected: fail with `Class "App\Mail\ContactMessage" not found`.

**Step 3: Commit the failing test**

```bash
git add tests/Feature/ContactMessageTest.php
git commit -m "Add failing test for ContactMessage mailable"
```

---

## Task 3: Implement Mailable + email view

**Goal:** Make the test from Task 2 pass.

**Files:**
- Create: `app/Mail/ContactMessage.php` (via `php artisan make:mail`)
- Create: `resources/views/mail/contact.blade.php`

**Step 1: Generate the Mailable**

Run: `php artisan make:mail ContactMessage --view=mail.contact --no-interaction`

**Step 2: Replace generated file contents**

Overwrite `app/Mail/ContactMessage.php` with:

```php
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public string $messageBody,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "New contact form message from {$this->name}",
            replyTo: [new Address($this->email, $this->name)],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'mail.contact');
    }
}
```

**Step 3: Create the email view**

Create `resources/views/mail/contact.blade.php`:

```blade
<p><strong>From:</strong> {{ $name }} &lt;{{ $email }}&gt;</p>

<p><strong>Message:</strong></p>

<p>{!! nl2br(e($messageBody)) !!}</p>
```

**Step 4: Run the test to confirm it passes**

Run: `php artisan test --compact --filter=ContactMessageTest`
Expected: 1 passed.

**Step 5: Run Pint on changed files**

Run: `vendor/bin/pint --dirty --format agent`
Expected: no style errors (or auto-fixed).

**Step 6: Commit**

```bash
git add app/Mail/ContactMessage.php resources/views/mail/contact.blade.php
git commit -m "Add ContactMessage mailable and email view"
```

---

## Task 4: Write failing Volt component test

**Goal:** TDD the contact-dialog Volt component. Livewire component tests via `Livewire::test()`.

**Files:**
- Create: `tests/Feature/ContactDialogTest.php`

**Step 1: Write the tests**

```php
<?php

use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

beforeEach(function () {
    Mail::fake();
    config()->set('contact.recipient', 'owner@example.com');
});

it('sends mail when the form is submitted with valid data', function () {
    Livewire::test('contact-dialog')
        ->set('name', 'Ada Lovelace')
        ->set('email', 'ada@example.com')
        ->set('messageBody', 'Hello there.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('sent', true);

    Mail::assertSent(ContactMessage::class, function (ContactMessage $mail) {
        return $mail->hasTo('owner@example.com')
            && $mail->name === 'Ada Lovelace'
            && $mail->email === 'ada@example.com'
            && $mail->messageBody === 'Hello there.';
    });
});

it('validates required fields', function () {
    Livewire::test('contact-dialog')
        ->set('name', '')
        ->set('email', 'not-an-email')
        ->set('messageBody', '')
        ->call('submit')
        ->assertHasErrors(['name', 'email', 'messageBody']);

    Mail::assertNothingSent();
});

it('silently succeeds and sends nothing when the honeypot is filled', function () {
    Livewire::test('contact-dialog')
        ->set('name', 'Ada')
        ->set('email', 'ada@example.com')
        ->set('messageBody', 'hi')
        ->set('website', 'https://spam.example')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('sent', true);

    Mail::assertNothingSent();
});
```

**Step 2: Run the tests to confirm they fail**

Run: `php artisan test --compact --filter=ContactDialogTest`
Expected: fail with `Unable to find component: [contact-dialog]`.

**Step 3: Commit the failing tests**

```bash
git add tests/Feature/ContactDialogTest.php
git commit -m "Add failing tests for contact-dialog Volt component"
```

---

## Task 5: Implement the Volt contact-dialog component

**Goal:** Make the Task 4 tests pass. Class-based Volt to match the existing `home.blade.php` sibling.

**Files:**
- Create: `resources/views/livewire/contact-dialog.blade.php`

**Step 1: Create the component**

```blade
<?php

use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {
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
```

**Step 2: Run the tests to confirm they pass**

Run: `php artisan test --compact --filter=ContactDialogTest`
Expected: 3 passed.

**Step 3: Run the whole suite to confirm no regressions**

Run: `php artisan test --compact`
Expected: all tests pass.

**Step 4: Run Pint**

Run: `vendor/bin/pint --dirty --format agent`
Expected: no errors.

**Step 5: Commit**

```bash
git add resources/views/livewire/contact-dialog.blade.php
git commit -m "Add contact-dialog Volt component"
```

---

## Task 6: Wire the dialog into the header

**Goal:** Replace the Twitter "connect" link with a button that opens the dialog, and mount the Livewire component once inside the header.

**Files:**
- Modify: `resources/views/components/header.blade.php` (line 10 — the Twitter link)

**Step 1: Replace the Twitter link**

In `resources/views/components/header.blade.php`, replace line 10:

```blade
<a class="hover:text-red-900" href="https://twitter.com/AndrewRhyand">connect</a>
```

with:

```blade
<button
    type="button"
    class="hover:text-red-900"
    onclick="document.getElementById('contact-dialog').showModal()"
>
    contact
</button>
```

**Step 2: Mount the dialog component inside the header**

At the bottom of `header.blade.php`, just before the closing `</header>` tag, add:

```blade
<livewire:contact-dialog />
```

**Step 3: Run the smoke test to confirm the home page still renders**

Run: `php artisan test --compact --filter=SmokeTest`
Expected: all smoke tests pass (home page includes the header, which now includes the dialog component).

**Step 4: Run the whole suite**

Run: `php artisan test --compact`
Expected: all green.

**Step 5: Commit**

```bash
git add resources/views/components/header.blade.php
git commit -m "Replace header Twitter link with contact dialog button"
```

---

## Task 7: Manual verification

**Goal:** Confirm the feature works end-to-end in the browser before declaring done. `MAIL_MAILER=log` in local `.env`, so the rendered email lands in `storage/logs/laravel.log`.

**Step 1: Start the dev server**

In one terminal: `php artisan serve`
In another: `npm run dev`

**Step 2: Open the home page**

Visit the URL from `mcp__laravel-boost__get-absolute-url` (or `http://localhost:8000`).

**Step 3: Click "contact"**

Expected: native dialog opens centered with a backdrop; form shows name / email / message fields.

**Step 4: Submit an empty form**

Expected: three validation errors appear inline under the respective fields. No log entry.

**Step 5: Submit a valid form**

Enter a name, valid email, and a message. Click **send**.
Expected: button shows "sending…" briefly, then the dialog swaps to the success panel. Close the dialog — click "contact" again and the form is reset.

**Step 6: Verify the email was "sent"**

Read the tail of `storage/logs/laravel.log` (use `mcp__laravel-boost__read-log-entries` or `tail -n 60 storage/logs/laravel.log`). Expected: a log entry with subject "New contact form message from …" and the message body rendered.

**Step 7: Confirm no browser console errors**

Use `mcp__laravel-boost__browser-logs`. Expected: no errors.

**Step 8: (Production-only) swap `MAIL_MAILER` and App Password**

This step is for the user, not for Claude:
- Generate a Gmail App Password: Google Account → Security → 2-Step Verification → App passwords.
- In the production environment, set `MAIL_MAILER=smtp` and fill `MAIL_PASSWORD` with the 16-char App Password.
- Send a real test submission from production to confirm delivery.

---

## Out of scope (do NOT implement)

- Queued sending
- Rate-limit middleware
- CAPTCHA
- Storing messages in the database
- A `/contact` page route
