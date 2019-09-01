<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;

class ApiController extends BaseApiController
{
    public function index(Request $request)
    {
        $data = QueryBuilder::for(Contact::class)
            ->allowedFilters([
                Filter::custom('created_at,name,email,message', FilterOr::class),
            ])
            ->paginate($request->input('per_page'));

        return $data;
    }

    public function destroy(Contact $contact)
    {
        $deleted = $contact->delete();

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
