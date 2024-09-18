<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UserDataTable;
use App\Enums\PermissionsGuard;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Tagger;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('dashboard.users.index');
    }

    public function create(Request $request)
    {
        $roles = Role::whereGuardName(PermissionsGuard::user)->pluck("title", "name");
        return view('dashboard.users.create', compact("roles"));
    }

    public function store(UserStoreRequest $request)
    {
        // todo:: move to service
        DB::transaction(static function () use ($request){
            $password = Hash::make($request->get("_password"));
            $user = User::create([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "password" => $password,
                "phone" => $request->input('phone'),
                "status" => UserStatus::active,
                "status_by" => auth("user")->id(),
                "status_datetime" => now(),
            ]);

            $role = $request->get("role");
            $user->assignRole($role);

            if($request->has("avatar_storage_path")){
                update_media($request->only("avatar_storage_path") , $user , "avatar_storage_path" , "avatar");
            }

            Flash::success(__("User $user->name has created successfully"));
        });

        return redirect()->route('dashboard.users.index');
    }

    public function show(Request $request, User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    public function edit(Request $request, User $user)
    {
        $roles = Role::whereGuardName(PermissionsGuard::user)->pluck("title", "name");
        return view('dashboard.users.edit', compact('user' , 'roles'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        // todo:: move to service
        DB::transaction(static function () use ($user , $request){
            if($request->filled("_password")) {
                $password = Hash::make($request->get("_password"));
                $user->update([
                    "password" => $password,
                ]);
            }

            $user->update([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "phone" => $request->input('phone'),
            ]);

            $role = $request->get("role");
            $user->syncRoles($role);

            if($request->has("avatar_storage_path")){
                update_media($request->only("avatar_storage_path") , $user , "avatar_storage_path" , "avatar");
            }

            Flash::success(__("User $user->name has updated successfully"));
        });

        return redirect()->route('dashboard.users.index');
    }

    public function status(Request $request, User $user)
    {
        return view('dashboard.users.status', compact('user'));
    }

    public function changeStatus(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $validated_inputs = $request->validate([
            'status' => ['required', 'in:' . implode(",", array_keys(UserStatus::values()))],
        ]);

        DB::transaction(static function () use ($user , $validated_inputs){
            $user->update([
                "status" => $validated_inputs['status'],
                "status_by" => auth()->id(),
                "status_datetime" => now(),
            ]);

            Flash::success(__("User $user->name change  successfully"));
        });

        return redirect()->route('dashboard.users.index');
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();
        Flash::success(__("User $user->name has deleted successfully"));
        return redirect()->route('dashboard.users.index');
    }
}
