<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Laracasts\Flash\Flash;

class DevelopmentController extends Controller
{
    public function __construct()
    {
        if (!app()->hasDebugModeEnabled()) {
            abort(403, 'Debug mode is not enabled.');
        }
    }

    public function result(Request $request)
    {
        $output = $request->query("output");
        $operation = $request->query("operation");

        return view("deploy.result" , compact("operation" , "output"));
    }

    public function clearCache(): RedirectResponse
    {
        Artisan::call('optimize:clear');
        $output = Artisan::output();
        Flash::info($output);

        return redirect(route("deploy.result" , ["output" => $output , "operation" => __FUNCTION__]));
    }

    public function migrate(): RedirectResponse
    {
        Artisan::call('migrate');
        $output = Artisan::output();
        Flash::info($output);

        return redirect(route("deploy.result" , ["output" => $output , "operation" => __FUNCTION__]));
    }

    public function seed(?string $seeder = null): RedirectResponse
    {
        if(empty($seeder)) {
            Artisan::call('db:seed');
        }else{
            Artisan::call("db:seed $seeder");
        }

        $output = Artisan::output();
        Flash::info($output);

        return redirect(route("deploy.result" , ["output" => $output , "operation" => __FUNCTION__]));
    }

    public function storageLink(): RedirectResponse
    {
        Artisan::call('storage:link');
        $output = Artisan::output();
        Flash::info($output);

        return redirect(route("deploy.result" , ["output" => $output , "operation" => __FUNCTION__]));
    }

    public function migrateRefresh(): RedirectResponse
    {
        Artisan::call('migrate:fresh');
        $output = Artisan::output();
        Flash::info($output);

        return redirect(route("deploy.result" , ["output" => $output , "operation" => __FUNCTION__]));
    }

    public function migrateRefreshSeed(): RedirectResponse
    {
        Artisan::call('migrate:fresh --seed');
        $output = Artisan::output();
        Flash::info($output);

        return redirect(route("deploy.result" , ["output" => $output , "operation" => __FUNCTION__]));
    }

    public function deployment(): RedirectResponse
    {
        Artisan::call('migrate --force');
        $output = Artisan::output();
        Flash::info($output);

        return redirect(route("deploy.result" , ["output" => $output , "operation" => __FUNCTION__]));
    }
    public function down(): RedirectResponse
    {
        Artisan::call('down');
        $output = Artisan::output();
        Flash::info($output);

        return redirect(route("deploy.result" , ["output" => $output , "operation" => __FUNCTION__]));
    }

    public function up(): RedirectResponse
    {
        Artisan::call('up');
        $output = Artisan::output();
        Flash::info($output);

        return redirect(route("deploy.result" , ["output" => $output , "operation" => __FUNCTION__]));
    }
}
