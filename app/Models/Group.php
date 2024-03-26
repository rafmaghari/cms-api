<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'leader_id',
        'organization_id',
        'deactivated_at',
        'created_by'
    ];

    public function deactivatedAt(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => filled($value) ? Carbon::parse($value)->format('M d Y') : null
        );
    }

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id', 'id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
