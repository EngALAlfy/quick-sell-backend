<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasTranslations;

    public array $translatable = [
        "title",
    ];

    protected $fillable = [
        'name',
        'guard_name',
        'title',
        'group_id',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(PermissionGroup::class, 'group_id');
    }
}
