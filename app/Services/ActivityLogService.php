<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;
use JetBrains\PhpStorm\ArrayShape;
use UAParser\Exception\FileNotFoundException;

class ActivityLogService
{
    /**
     * log user role updates
     * @param $user
     * @param $old_role
     * @param $new_role
     * @return void
     */
    public static function userRoleUpdated($user , $old_role , $new_role): void
    {
        $changes = [];
        $changes["old"] = [
            "role_name" => $old_role,
        ];

        $changes["attributes"] = [
            "role_name" => $new_role,
        ];

        try {
            self::log("updated", "User #$user->id has been updated to new role $new_role", $changes, $user);
        } catch (FileNotFoundException $e) {
            LogService::error("1000023" , $e , "Error while log user update" , __FUNCTION__ , __CLASS__);
        }
    }


    /**
     * Base activity manual log
     * @param $action
     * @param $description
     * @param array $data
     * @param null $model
     * @return void
     * @throws FileNotFoundException
     */
    public static function log($action, $description, array $data = [], $model = null): void
    {
        $logger = activity();
        if ($model !== null) {
            $logger = $logger->on($model);
        }

        $properties = array_merge(
            $data,
            self::getDefaultProperties()
        );
        $logger
            ->setEvent($action)
            ->by(auth()->user())
            ->withProperties($properties)
            ->log($description);
    }


    /**
     * Default data for logging
     * @return array
     * @throws FileNotFoundException
     */
    #[ArrayShape(['agent' => "array", 'route' => "array"])] public static function getDefaultProperties(): array
    {
        return [
            'agent' => getUserAgent(),
            'route' => ["name" => Route::currentRouteName(), "method" => request()->method(), "path" => request()->path(), "url" => request()->fullUrl()],
        ];
    }
}
