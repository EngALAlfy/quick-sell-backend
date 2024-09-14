<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Laracasts\Flash\Flash;

class SettingsController extends Controller
{
    function index()
    {
        return view("dashboard.settings.index");
    }


    public function store(Request $request){
        $input = $request->validate([
            "logo_path_name" => 'required',
            "logo_path_storage_path" => 'required',
            "logo_path_public_path" => 'required',
            "title" => 'required|max:200',
            "description" => 'required|max:500',
        ]);

        settings($input);

        Flash::success(__("Settings updated successfully"));
        return redirect()->back();
    }
}
