<?php
namespace TypiCMS\Modules\Contacts\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Events\Dispatcher;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class EventHandler {

    public function onCreate(Model $model)
    {

        // Send a mail to visitor
        Mail::send('contacts::mails.message-to-visitor', ['model' => $model], function (Message $message) use ($model) {
            $subject  = '[' . TypiCMS::title() . '] ';
            $subject .= trans('contacts::global.Thank you for your contact request');
            $message->to($model->email)->subject($subject);
        });

        // Send a mail to webmaster
        Mail::send('contacts::mails.message-to-webmaster', ['model' => $model], function (Message $message) {
            $subject  = '[' . TypiCMS::title() . '] ';
            $subject .= trans('contacts::global.New contact request');
            $message->to(config('typicms.webmaster_email'))->subject($subject);
        });

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('NewContactRequest', 'TypiCMS\Modules\Contacts\Events\EventHandler@onCreate');
    }

}
