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
