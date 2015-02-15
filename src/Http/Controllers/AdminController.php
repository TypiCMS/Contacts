<?php
namespace TypiCMS\Modules\Contacts\Http\Controllers;

use TypiCMS\Http\Controllers\AdminSimpleController;
use TypiCMS\Modules\Contacts\Http\Requests\FormRequest;
use TypiCMS\Modules\Contacts\Repositories\ContactInterface;

class AdminController extends AdminSimpleController
{

    public function __construct(ContactInterface $contact)
    {
        parent::__construct($contact);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FormRequest $request
     * @return Redirect
     */
    public function store(FormRequest $request)
    {
        $model = $this->repository->create($request->all());
        return $this->redirect($request, $model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     * @param  FormRequest $request
     * @return Redirect
     */
    public function update($model, FormRequest $request)
    {
        $this->repository->update($request->all());
        return $this->redirect($request, $model);
    }
}
