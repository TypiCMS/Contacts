<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use TypiCMS\Modules\Contacts\Http\Requests\FormRequest;
use TypiCMS\Modules\Contacts\Repositories\ContactInterface;
use TypiCMS\Modules\Core\Http\Controllers\BasePublicController;

class PublicController extends BasePublicController
{
    protected $form;

    public function __construct(ContactInterface $contact)
    {
        parent::__construct($contact);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function form()
    {
        return view('contacts::public.form');
    }

    /**
     * Display a page when form is sent.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function sent()
    {
        if (session('success')) {
            return view('contacts::public.sent');
        }

        return redirect(url('/'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function store(FormRequest $request)
    {
        $data = [];
        foreach ($request->all() as $key => $value) {
            $data[$key] = strip_tags($value);
        }
        $contact = $this->repository->create($data);

        event('NewContactRequest', [$contact]);

        return redirect()->route(config('app.locale').'.contacts.sent')
            ->with('success', true);
    }
}
