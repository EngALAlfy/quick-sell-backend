<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PermissionGroupController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view("admin.permission-groups.create");
    }

    public function store(Request $request)
    {
        // todo:: move to form request
        $request->validate([
            "name" => "required|array|max:" . count(supported_languages()),
            "name.*" => "required|max:255",
        ]);

        PermissionGroup::create([
            "name" => $request->input('name'),
        ]);

        Flash::success(__("PermissionGroup created successfully"));
        return redirect()->back();
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
