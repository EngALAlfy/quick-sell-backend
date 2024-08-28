<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AdminsService;
use App\Services\Facades\AdminsServiceFacade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if ($credentials["email"] === "demo") {
            abort_unless(app()->isLocal(), 403);
        }

        if (Auth::guard("admin")->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            AdminsServiceFacade::recordLoginData($request);

            return redirect()->intended('/admin/home');
        }

        flash(__("auth.failed"))->error();

        return back()->withInput();
    }

    public function logout(): RedirectResponse
    {
        Auth::guard("admin")->logout();
        return redirect()->route('admin.login');
    }

}
