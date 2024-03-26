<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'deactivated_at' => $this->deactivated_at,
            'leader_id' => $this->leader_id,
            'organization_id' => $this->organization_id,
            'created_by' => $this->created_by,
            'leader' => $this->leader->full_name ?? '',
            'organization' => $this->organization->name ?? '',
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
