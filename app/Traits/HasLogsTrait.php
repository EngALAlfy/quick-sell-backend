<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use UAParser\Exception\FileNotFoundException;
use UAParser\Parser;

trait HasLogsTrait {
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(getOnlyClassName($this->getModel()::class))
            ->logAll()
            ->logExcept([
                "updated_at",
                "remember_token",
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function (string $eventName){
                return  getOnlyClassName($this->getModel()::class) . " has been $eventName";
            });
    }

    /**
     * @throws FileNotFoundException
     */
    public function tapActivity(Activity $activity, string $eventName): void
    {
        $activity->properties = $activity->properties->put('agent', getUserAgent())->put("route" , ["name" => Route::currentRouteName()
            ,"method" => request()->method() ,"path" => request()->path(), "url" => request()->fullUrl()]);
    }

}
