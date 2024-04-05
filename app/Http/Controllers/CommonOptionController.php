<?php

namespace App\Http\Controllers;

use App\Http\Resources\OptionResource;
use App\Models\Group;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class CommonOptionController extends Controller
{
    public function leaders(): AnonymousResourceCollection
    {
        $leaders = QueryBuilder::for(User::class)
            ->selectRaw("id as value, CONCAT(first_name, ' ', last_name) as label")
            ->get();

        return OptionResource::collection($leaders);
    }

    public function organizations(): AnonymousResourceCollection
    {
        $organizations = QueryBuilder::for(Organization::class)
            ->selectRaw("id as value, name as label")
            ->get();

        return OptionResource::collection($organizations);
    }

    public function groups(): AnonymousResourceCollection
    {
        $groups = QueryBuilder::for(Group::class)
            ->selectRaw("id as value, name as label")
            ->get();

        return OptionResource::collection($groups);
    }

    public function users()
    {
        $users = QueryBuilder::for(User::class)
            ->selectRaw("id as value, name as label")
            ->get();

        return OptionResource::collection($users);

    }
}
