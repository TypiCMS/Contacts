<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Contacts\Repositories\EloquentContact;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;

class ApiController extends BaseApiController
{
    public function __construct(EloquentContact $contact)
    {
        parent::__construct($contact);
    }

    public function index(Request $request)
    {
        $data = QueryBuilder::for(Contact::class)
            ->allowedFilters([
                Filter::custom('created_at,first_name,last_name,email,message', FilterOr::class),
            ])
            ->paginate($request->input('per_page'));

        return $data;
    }

    public function destroy(Contact $contact)
    {
        $deleted = $this->repository->delete($contact);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
