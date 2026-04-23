# Contact Form Design

**Date:** 2026-04-22
**Status:** Approved, ready for implementation plan

## Goal

Replace the "connect" link in the site header (currently pointing to Twitter) with a button that opens a lightweight contact dialog. Submissions are emailed to the site owner's personal Gmail inbox. Must work identically in local and production environments with minimal dependencies.

## Non-goals

- Storing messages in the database
- Queued / background sending
- CAPTCHA or rate-limiting middleware
- Rich-text / attachments
- A dedicated `/contact` page route

## Approach

Native HTML `<dialog>` element + single Volt component + Laravel Mail via Gmail SMTP using a Google App Password. No new packages. No JavaScript framework beyond Livewire's existing runtime.

## Files

| Path | Purpose |
|---|---|
| `app/Mail/ContactMessage.php` | Mailable carrying `name`, `email`, `message`. Sets `From: MAIL_FROM_ADDRESS`, `Reply-To: <visitor email>`. |
| `resources/views/mail/contact.blade.php` | Plain Blade view rendering the email body. |
| `resources/views/components/contact-dialog.blade.php` | Volt single-file component: native `<dialog>`, form, `submit()` action, success/error UI. |
| `resources/views/components/header.blade.php` | Replace Twitter link (line 10) with a button that calls `showModal()` on the dialog. Include `<x-contact-dialog />` in the header. |
| `config/contact.php` | `['recipient' => env('CONTACT_RECIPIENT')]`. |
| `.env` / `.env.example` | Gmail SMTP vars + `CONTACT_RECIPIENT`. |
| `tests/Feature/ContactFormTest.php` | Pest feature tests. |

## Data flow

1. User clicks **contact** button in header.
2. Button's `onclick="document.getElementById('contact-dialog').showModal()"` opens the native dialog.
3. User fills form (name, email, message) and submits.
4. Volt `submit()` method:
   - Validates: `name: required|string|max:100`, `email: required|email|max:255`, `message: required|string|max:2000`.
   - Checks honeypot field (`website`) is empty — if filled, short-circuit to success without sending.
   - Dispatches `Mail::to(config('contact.recipient'))->send(new ContactMessage($name, $email, $message))` synchronously.
5. On success: swap form for a "thanks, message sent" panel with a close button.
6. On mail exception: show inline error, keep the form filled so the user can retry.

## Env vars

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=<16-char Gmail App Password>
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-gmail@gmail.com
MAIL_FROM_NAME="andrewrhyand.com"
CONTACT_RECIPIENT=your-gmail@gmail.com
```

Local dev can keep `MAIL_MAILER=log` to avoid real sends; rendered email lands in `storage/logs/laravel.log`.

## Spam protection

Single honeypot input named `website`, hidden via `sr-only` + `tabindex="-1"` + `autocomplete="off"`. Bots autofill visible-ish inputs; real users don't. If filled, the request silently reports success without sending mail. No CAPTCHA, no throttle middleware — can be added later if abuse materializes.

## Security

- Gmail App Password is stored only in `.env` (gitignored) and production environment config. Revocable instantly from Google Account → Security → App Passwords.
- Recipient address lives server-side in `config/contact.php`; never rendered to the browser.
- `Reply-To` carries the visitor's address so the `From` header passes SPF/DKIM as authenticated Gmail.

## Tests (Pest feature)

1. Valid submission dispatches `ContactMessage` to `CONTACT_RECIPIENT` with the expected payload (using `Mail::fake()` + `Mail::assertSent`).
2. Missing / invalid `name`, `email`, `message` surface validation errors and do not dispatch mail.
3. Filled honeypot returns success UI but dispatches nothing (`Mail::assertNothingSent`).

Livewire component tests via `Livewire::test()` against the Volt component.

## Out of scope / future

- Queued sending (switch `->send()` to `->queue()` + configure a queue worker if latency becomes an issue).
- Rate-limiting (wrap submit in `RateLimiter` if spam gets through honeypot).
- Persisting messages to DB.
