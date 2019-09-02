<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use TypiCMS\Modules\Contacts\Http\Requests\FormRequest;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('contacts::admin.index');
    }

    public function create(): View
    {
        $model = new Contact;

        return view('contacts::admin.create')
            ->with(compact('model'));
    }

    public function edit(Contact $contact): View
    {
        return view('contacts::admin.edit')
            ->with(['model' => $contact]);
    }

    public function store(FormRequest $request): RedirectResponse
    {
        $contact = Contact::create($request->all());

        return $this->redirect($request, $contact);
    }

    public function update(Contact $contact, FormRequest $request): RedirectResponse
    {
        $contact->update($request->all());

        return $this->redirect($request, $contact);
    }
}
