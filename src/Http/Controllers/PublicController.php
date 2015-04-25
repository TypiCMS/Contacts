<?php
namespace TypiCMS\Modules\Contacts\Http\Controllers;

use Redirect;
use TypiCMS\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Contacts\Http\Requests\FormRequest;
use TypiCMS\Modules\Contacts\Repositories\ContactInterface;

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
     * @return Response
     */
    public function form()
    {
        return view('contacts::public.form');
    }

    /**
     * Display a page when form is sent.
     *
     * @return Response
     */
    public function sent()
    {
        return view('contacts::public.sent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(FormRequest $request)
    {
        $data = [];
        foreach ($request->all() as $key => $value) {
            $data[$key] = e($value);
        }
        $contact = $this->repository->create($data);

        event('NewContactRequest', [$contact]);

        return Redirect::route(config('app.locale') . '.contacts.sent')
            ->with('success', true);
    }
}
