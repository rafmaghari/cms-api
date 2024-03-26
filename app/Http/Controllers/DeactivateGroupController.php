<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;

class DeactivateGroupController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'group_id' => ['required', 'exists:groups,id']
        ]);

        $group = Group::find($validated['group_id']);
        $group->update(['deactivated_at' => now()->format('Y-m-d')]);

        return GroupResource::make($group->fresh());
    }
}
