<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationStoreRequest;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use App\Traits\ApiResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrganizationController extends Controller
{
    use ApiResponse;

    public function index(): AnonymousResourceCollection
    {
        $organizations = QueryBuilder::for(Organization::class)
            ->allowedFilters([
                AllowedFilter::partial('name')
            ])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return OrganizationResource::collection($organizations);
    }

    public function store(OrganizationStoreRequest $request): OrganizationResource
    {
        $organization = Organization::create($request->validated() + ['created_by' => auth()->id()]);

        return new OrganizationResource($organization);
    }

    public function show(Organization $organization): OrganizationResource
    {
        return OrganizationResource::make($organization);
    }

    public function update(OrganizationStoreRequest $request, Organization $organization): OrganizationResource
    {
        $organization->update($request->validated());

        return OrganizationResource::make($organization->fresh());
    }

    public function destroy(Organization $organization): Response
    {
        $organization->delete();

        return $this->emptyDataResponse();
    }
}
