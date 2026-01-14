<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Contacts\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactRequest extends Notification
{
    use Queueable;

    public function __construct(
        private readonly mixed $contact,
    ) {}

    /** @return string[] */
    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject('[' . websiteTitle() . '] ' . __('New contact request'))
            ->markdown('contacts::mail.new-contact-request', ['contact' => $this->contact]);
    }
}
