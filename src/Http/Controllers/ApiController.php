<?php

namespace TypiCMS\Modules\Contacts\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Contact::class)
            ->allowedSorts(['created_at', 'name', 'email', 'message'])
            ->allowedFilters([
                AllowedFilter::custom('created_at,name,email,message', new FilterOr),
            ])
            ->paginate($request->input('per_page'));

        return $data;
    }

    public function destroy(Contact $contact): JsonResponse
    {
        $deleted = $contact->delete();

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
