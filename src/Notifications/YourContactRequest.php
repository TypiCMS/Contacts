<?php

namespace TypiCMS\Modules\Contacts\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class YourContactRequest extends Notification
{
    use Queueable;

    private $contact;

    /**
     * Create a new notification instance.
     *
     * @param mixed $contact
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject('[' . websiteTitle() . '] ' . __('Thank you for your contact request.'))
            ->markdown('contacts::mail.your-new-contact-request', ['contact' => $this->contact]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
        ];
    }
}
