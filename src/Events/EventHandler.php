<?php

namespace TypiCMS\Modules\Contacts\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Events\Dispatcher;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class EventHandler
{
    public function onCreate(Model $model)
    {
        $webmaster = config('typicms.webmaster_email');

        // Send a mail to visitor
        Mail::send('contacts::mails.message-to-visitor', ['model' => $model], function (Message $message) use ($model, $webmaster) {
            $subject = '['.TypiCMS::title().'] ';
            $subject .= trans('contacts::global.Thank you for your contact request');
            $message->from($webmaster)->to($model->email)->subject($subject);
        });

        // Send a mail to webmaster
        Mail::send('contacts::mails.message-to-webmaster', ['model' => $model], function (Message $message) use ($model, $webmaster) {
            $subject = '['.TypiCMS::title().'] ';
            $subject .= trans('contacts::global.New contact request');
            $sender = config('mail.from.address');
            $message->from($model->email)->sender($sender)->to($webmaster)->subject($subject);
        });
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param Dispatcher $events
     *
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('NewContactRequest', 'TypiCMS\Modules\Contacts\Events\EventHandler@onCreate');
    }
}
