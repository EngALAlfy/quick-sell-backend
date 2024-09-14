<?php

namespace App\Models;

use App\Traits\HasCreatedByTrait;
use App\Traits\HasLogsTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Model implements HasMedia
{
    use HasCreatedByTrait;
    use HasLogsTrait;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'contact_information',
    ];
}
