<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use TypiCMS\Modules\Contacts\Http\Requests\FormRequest;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Contacts\Repositories\EloquentContact;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController
{
    public function __construct(EloquentContact $contact)
    {
        parent::__construct($contact);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->findAll();
        app('JavaScript')->put('models', $models);

        return view('contacts::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->createModel();
        app('JavaScript')->put('model', $model);

        return view('contacts::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Contacts\Models\Contact $contact
     *
     * @return \Illuminate\View\View
     */
    public function edit(Contact $contact)
    {
        app('JavaScript')->put('model', $contact);

        return view('contacts::admin.edit')
            ->with(['model' => $contact]);
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
        $this->repository->update($request->id, $request->all());

        return $this->redirect($request, $contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \TypiCMS\Modules\Contacts\Models\Contact $contact
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Contact $contact)
    {
        $deleted = $this->repository->delete($contact);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
