<?php

namespace App\Mail;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * A "Mailable" is Laravel's way of representing one email as a PHP
 * class: what it's about (envelope/subject) and what it says
 * (content/body). We build this object in the controller and hand it
 * to Mail::send(), and Laravel takes care of actually delivering it
 * through whatever mail driver is configured in .env (for us, that's
 * Mailpit — see MAIL_MAILER/MAIL_HOST/MAIL_PORT in .env).
 */
class CrmNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The notification row this email is built from — stored here so
     * the view (content()) below can read its title/message when
     * Laravel renders the actual email.
     */
    public Notification $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * The envelope = the email's "outside": subject line, etc.
     * We reuse the notification's own title as the subject so the
     * two always stay in sync.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->notification->title,
        );
    }

    /**
     * The content = the email's "inside": which Blade view renders
     * the body, and what data that view gets. 'notification' here
     * becomes a $notification variable inside the Blade file below.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.crm-notification',
            with: [
                'notification' => $this->notification,
            ],
        );
    }
}
