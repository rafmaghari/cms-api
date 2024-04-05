<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupStoreRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Traits\ApiResponse;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GroupController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $groups = QueryBuilder::for(Group::class)
            ->allowedFilters([
                AllowedFilter::partial('name')
            ])
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return GroupResource::collection($groups);
    }

    public function store(GroupStoreRequest $request)
    {
        $group = Group::create($request->validated() + ['created_by' => auth()->id()]);

        return new GroupResource($group);
    }

    public function show(Group $group)
    {
        return GroupResource::make($group);
    }

    public function update(GroupStoreRequest $request, Group $group)
    {
        $group->update($request->validated());

        return GroupResource::make($group->refresh());
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return $this->emptyDataResponse();
    }
}
