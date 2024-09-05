<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\PermissionsGuard;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PermissionController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $groups = PermissionGroup::pluck("name" , "id");
        return view("dashboard.permissions.create" , compact("groups"));
    }

    public function store(Request $request)
    {
        // todo:: move to form request
        $request->validate([
            "name" => "required|max:255|min:3",
            "title" => "required|array|max:" . count(supported_languages()),
            "title.*" => "required|max:255",
            "group_id" => "required|exists:permission_groups,id",
            "guard_name" => "required|in:" . implode("," , PermissionsGuard::values()),
        ]);

        Permission::create([
            "name" => $request->input('name'),
            "title" => $request->input('title'),
            "group_id" => $request->input('group_id'),
            "guard_name" => $request->input('guard_name'),
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
