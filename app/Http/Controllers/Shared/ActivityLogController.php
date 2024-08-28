<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    function index()
    {
        $activityLogs = Activity::latest()->paginate(25);
        return view("admin.settings.activity-log.index" , compact("activityLogs"));
    }

    function clearAll()
    {
        Activity::query()->delete();
        Flash::success("All data deleted successfully");
        return redirect()->back();
    }
    function show($log)
    {
        $activity = Activity::where("id" , $log)->first();
        return view("admin.settings.activity-log.show" , compact("activity"));
    }
}
