<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ClientDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class ClientController extends Controller
{
    public function index(ClientDataTable $dataTable)
    {
        return $dataTable->render('dashboard.clients.index');
    }

    public function create(Request $request)
    {
        return view('dashboard.clients.create');
    }

    public function store(ClientStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $client = Client::create($request->validated());

            Flash::success(__("Client $client->name has been created successfully"));
        });

        return redirect()->back();
    }

    public function show(Request $request, Client $client)
    {
        return view('dashboard.clients.show', compact('client'));
    }

    public function edit(Request $request, Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    }

    public function update(ClientUpdateRequest $request, Client $client)
    {
        DB::transaction(function () use ($request, $client) {
            $client->update($request->validated());

            Flash::success(__("Client $client->name has been updated successfully"));
        });

        return redirect()->route('dashboard.clients.index');
    }

    public function destroy(Request $request, Client $client)
    {
        $client->delete();
        Flash::success(__("Client $client->name has been deleted successfully"));
        return redirect()->route('dashboard.clients.index');
    }
}
