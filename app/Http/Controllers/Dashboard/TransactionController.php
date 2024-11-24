<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\TransactionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     *
     * @param TransactionDataTable $dataTable
     * @return \Illuminate\View\View
     */
    public function index(TransactionDataTable $dataTable)
    {
        return $dataTable->render('dashboard.transactions.index');
    }

    /**
     * Display the specified transaction.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return \Illuminate\View\View
     */
    public function show(Request $request, Transaction $transaction)
    {

        return view('dashboard.transactions.show', compact('transaction'));
    }
}
