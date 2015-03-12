<?php
namespace TypiCMS\Modules\Contacts\Http\Controllers;

use App;
use Illuminate\Support\Str;
use View;
use Input;
use Session;
use Redirect;
use TypiCMS;
use TypiCMS\Modules\Contacts\Http\Requests\FormRequest;
use TypiCMS\Modules\Contacts\Repositories\ContactInterface;
use TypiCMS\Http\Controllers\BasePublicController;

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
        $this->repository->create($data);
        return Redirect::route(App::getlocale() . '.contacts.sent')
            ->with('success', true);
    }
}
