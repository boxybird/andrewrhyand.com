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
