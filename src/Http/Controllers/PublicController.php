<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;
use TypiCMS\Modules\Contacts\Http\Requests\FormRequest;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Contacts\Notifications\NewContactRequest;
use TypiCMS\Modules\Contacts\Notifications\YourContactRequest;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;

class PublicController extends BasePublicController
{
    public function form(): View
    {
        return view('contacts::public.form');
    }

    public function sent(): View|RedirectResponse
    {
        if (session('success')) {
            return view('contacts::public.sent');
        }

        return redirect(url('/'));
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $data = [];
        foreach ($request->validated() as $key => $value) {
            $data[$key] = strip_tags($value);
        }
        $contact = Contact::query()->create($data);

        Notification::route('mail', config('typicms.webmaster_email'))
            ->notify(new NewContactRequest($contact));

        Notification::route('mail', $request->string('email'))
            ->notify(new YourContactRequest($contact));

        return redirect()->route(app()->getLocale() . '::contact-sent')
            ->with('success', true);
    }
}
