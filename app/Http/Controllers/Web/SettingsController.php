<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Laracasts\Flash\Flash;

class SettingsController extends Controller
{
    function index()
    {
        return view("admin.settings.index");
    }

    function clearCache()
    {
        $output = "";
        Artisan::call('cache:clear');
        $output .= "<br/>";
        $output .= Artisan::output();
        Artisan::call('view:clear');
        $output .= "<br/>";
        $output .= Artisan::output();
        Artisan::call('route:clear');
        $output .= "<br/>";
        $output .= Artisan::output();
        Artisan::call('config:clear');
        $output .= "<br/>";
        $output .= Artisan::output();
        Flash::success($output);

        return redirect()->back();
    }

    public function store(Request $request){
        $input = $request->validate([
            "logo_path_name" => 'required',
            "logo_path_storage_path" => 'required',
            "logo_path_public_path" => 'required',
            "title" => 'required|max:200',
            "description" => 'required|max:500',
            "followers_cheap_api_key" => 'required',
            "social_bar_enabled" => 'required',
            "social_bar_facebook" => 'nullable',
            "social_bar_youtube" => 'nullable',
            "social_bar_messenger" => 'nullable',
            "social_bar_whatsapp" => 'nullable',
            "social_bar_instagram" => 'nullable',
            "social_bar_telegram" => 'nullable',
        ]);

        settings($input);

        Flash::success(__("Settings updated successfully"));
        return redirect()->back();
    }
}
