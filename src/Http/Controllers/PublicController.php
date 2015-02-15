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
    public function index()
    {
        $model = $this->repository->getmodel();
        $formIsSent = Session::get('formIsSent');

        return view('contacts::public.form')
            ->with(compact('model', 'formIsSent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        App::setLocale(Input::get('locale'));

        if ($this->form->save(Input::all())) {
            Session::flash('formIsSent', true);
            return Redirect::back();
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($this->form->errors());

    }
}
