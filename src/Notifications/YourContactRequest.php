<?php

namespace TypiCMS\Modules\Contacts\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class YourContactRequest extends Notification
{
    use Queueable;

    public function __construct(private readonly mixed $contact) {}

    /** @return string[] */
    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject('[' . websiteTitle() . '] ' . __('Thank you for your contact request.'))
            ->markdown('contacts::mail.your-new-contact-request', ['contact' => $this->contact]);
    }
}
