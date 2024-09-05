<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Facades\UsersServiceFacade;
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

        if (Auth::guard()->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            UsersServiceFacade::recordLoginData($request);

            return redirect()->intended(route("dashboard.home.index"));
        }

        flash(__("auth.failed"))->error();

        return back()->withInput();
    }

    public function logout(): RedirectResponse
    {
        Auth::guard()->logout();
        return redirect()->route('dashboard.login');
    }

}
