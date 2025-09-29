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
    /** @return LengthAwarePaginator<int, mixed> */
    public function index(Request $request): LengthAwarePaginator
    {
        return QueryBuilder::for(Contact::class)
            ->allowedSorts(['created_at', 'name', 'email', 'message'])
            ->allowedFilters([
                AllowedFilter::custom('name,email,message', new FilterOr()),
            ])
            ->paginate($request->integer('per_page'));
    }

    public function destroy(Contact $contact): JsonResponse
    {
        $contact->delete();

        return response()->json(status: 204);
    }
}
