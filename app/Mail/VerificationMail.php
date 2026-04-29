<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $token;
    public string $verificationUrl;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
        $this->verificationUrl = route('verification.verify', [
            'token' => $this->token,
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Your TC Affiliate Account',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verification-mail',
            with: [
                'user' => $this->user,
                'verificationUrl' => $this->verificationUrl,
                'token' => $this->token,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}