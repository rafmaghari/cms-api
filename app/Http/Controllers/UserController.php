<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return UserResource::collection($users);
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated() + ['created_by' => auth()->id()]);

        return new UserResource($user);
    }

    public function show(User $user)
    {
        return UserResource::make($user);
    }

    public function update(UserStoreRequest $request, User $user)
    {
        $user->update($request->validated());

        return UserResource::make($user->refresh());
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }


}
