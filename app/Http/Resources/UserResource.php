<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'full_name' => $this->full_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'joined_at' => $this->joined_at,
            'email' => $this->email,
            'others' => $this->others,
            'phone_number' => $this->phone_number,
            'facebook_url' => $this->facebook_url,
            'group_name' => $this->group?->name,
            'group_id' => $this->group_id,
        ];
    }
}
