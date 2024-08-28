<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdminsDataTable;
use App\Enums\AdminStatus;
use App\Enums\PermissionsGuard;
use App\Events\NewAdminEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class AdminController extends Controller
{
    public function index(AdminsDataTable $dataTable)
    {
        return $dataTable->render('admin.admins.index');
    }

    public function create(Request $request)
    {
        $roles = Role::whereGuardName(PermissionsGuard::admin)->pluck("title", "name");
        return view('admin.admins.create', compact("roles"));
    }

    public function store(AdminStoreRequest $request)
    {
        // todo:: move to service
        DB::transaction(static function () use ($request){
            $password = Hash::make($request->get("_password"));
             $admin = Admin::create([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "password" => $password,
                "phone" => $request->input('phone'),
                "status" => AdminStatus::active,
                "status_by" => auth("admin")->id(),
            ]);

            $role = $request->get("role");
            $admin->assignRole($role);

            if($request->has("avatar_storage_path")){
                update_media($request->only("avatar_storage_path") , $admin , "avatar_storage_path" , "avatar");
            }

            NewAdminEvent::dispatch();
            Flash::success(__("Admin $admin->name has created successfully"));
        });

        return redirect()->route('admin.admins.index');
    }

    public function show(Request $request, Admin $admin)
    {
        return view('admin.admins.show', compact('admin'));
    }

    public function edit(Request $request, Admin $admin)
    {
        $roles = Role::whereGuardName(PermissionsGuard::admin)->pluck("title", "name");
        return view('admin.admins.edit', compact('admin' , 'roles'));
    }

    public function update(AdminUpdateRequest $request, Admin $admin)
    {
        // todo:: move to service
        DB::transaction(static function () use ($admin , $request){
            if($request->has("_password")) {
                $password = Hash::make($request->get("_password"));
                $admin->update([
                    "password" => $password,
                ]);
            }

            $admin->update([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
            ]);

            $role = $request->get("role");
            $admin->syncRoles($role);

            if($request->has("avatar_storage_path")){
                update_media($request->only("avatar_storage_path") , $admin , "avatar_storage_path" , "avatar");
            }

            Flash::success(__("Admin $admin->name has updated successfully"));
        });

        return redirect()->route('admin.admins.index');
    }

    public function destroy(Request $request, Admin $admin)
    {
        $admin->delete();
        Flash::success(__("Admin $admin->name has deleted successfully"));
        return redirect()->route('admin.admins.index');
    }
}
