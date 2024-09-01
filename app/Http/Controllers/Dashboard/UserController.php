<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function create(Request $request): Response
    {
        return view('user.create');
    }

    public function store(UserStoreRequest $request): Response
    {
        $user = User::create($request->validated());

        $request->session()->flash('user.id', $user->id);

        return redirect()->route('users.index');
    }

    public function show(Request $request, User $user): Response
    {
        return view('user.show', compact('user'));
    }

    public function edit(Request $request, User $user): Response
    {
        return view('user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user): Response
    {
        $user->update($request->validated());

        $request->session()->flash('user.id', $user->id);

        return redirect()->route('users.index');
    }

    public function destroy(Request $request, User $user): Response
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
