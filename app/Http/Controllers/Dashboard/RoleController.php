<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Admin\RolesDataTable;
use App\Enums\PermissionsGuard;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Models\PermissionGroup;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class RoleController extends Controller
{
    public function index(RolesDataTable $dataTable)
    {
        $adminRoles = Role::whereGuardName(PermissionsGuard::user)->with("users")->withCount("users")->with("permissions")->get();
        return $dataTable->render('dashboard.roles.index', compact("adminRoles"));
    }

    public function create(Request $request)
    {
        $groups = PermissionGroup::get();
        return view('dashboard.roles.create', compact("groups"));
    }

    public function store(RoleStoreRequest $request)
    {
        DB::transaction(static function () use ($request) {
            $role = Role::create([
                "title" => $request->input('title'),
                "level" => $request->input('level'),
                "name" => $request->input('name'),
                "guard_name" => $request->input('guard_name'),
            ]);

            $permissions = $request->get("permissions" , []);
            $role->permissions()->sync($permissions);
            Flash::success(__("Role $role->name has created successfully"));
        });

        return redirect()->back();
    }

    public function edit(Request $request , Role $role)
    {
        $groups = PermissionGroup::get();
        $role->load("permissions");
        return view('dashboard.roles.edit', compact("groups" , "role"));
    }

    public function update(RoleStoreRequest $request, Role $role)
    {
        DB::transaction(static function () use ($request , $role) {
            $role->update([
                "title" => $request->input('title'),
                "level" => $request->input('level'),
                "name" => $request->input('name'),
                "guard_name" => $request->input('guard_name'),
            ]);

            $permissions = $request->get("permissions" , []);
            $role->permissions()->sync($permissions);
            Flash::success(__("Role $role->name has updated successfully"));
        });

        return redirect()->back();
    }

    public function show(Request $request, Role $role)
    {
        return view('dashboard.roles.show', compact('role'));
    }

    public function destroy(Request $request, Role $role)
    {
        $role->delete();
        Flash::success(__("Role $role->name has deleted successfully"));
        return redirect()->back();
    }
}
