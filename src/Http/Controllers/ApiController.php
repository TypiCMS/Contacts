<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Contacts\Repositories\EloquentContact;

class ApiController extends BaseApiController
{
    public function __construct(EloquentContact $contact)
    {
        parent::__construct($contact);
    }

    public function index(Request $request)
    {
        $models = QueryBuilder::for(Contact::class)
            ->paginate($request->input('per_page'));

        return $models;
    }

    public function destroy(Contact $contact)
    {
        $deleted = $this->repository->delete($contact);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
