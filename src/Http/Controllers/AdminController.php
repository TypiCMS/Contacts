<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use TypiCMS\Modules\Contacts\Http\Requests\FormRequest;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Contacts\Repositories\ContactInterface;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController
{
    public function __construct(ContactInterface $contact)
    {
        parent::__construct($contact);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Contacts\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $contact = $this->repository->create($request->all());

        return $this->redirect($request, $contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Contacts\Models\Contact            $contact
     * @param \TypiCMS\Modules\Contacts\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Contact $contact, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $contact);
    }
}
