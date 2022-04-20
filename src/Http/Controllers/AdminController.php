<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TypiCMS\Modules\Contacts\Exports\Export;
use TypiCMS\Modules\Contacts\Http\Requests\FormRequest;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController
{
    public function index(): View
    {
        return view('contacts::admin.index');
    }

    public function export(Request $request)
    {
        $filename = date('Y-m-d').' '.config('app.name').' contacts.xlsx';

        return Excel::download(new Export(), $filename);
    }

    public function create(): View
    {
        $model = new Contact();

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
        $contact = Contact::create($request->validated());

        return $this->redirect($request, $contact)
            ->withMessage(__('Item successfully created.'));
    }

    public function update(Contact $contact, FormRequest $request): RedirectResponse
    {
        $contact->update($request->validated());

        return $this->redirect($request, $contact)
            ->withMessage(__('Item successfully updated.'));
    }
}
