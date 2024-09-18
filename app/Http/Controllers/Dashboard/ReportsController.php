<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function sales()
    {
        return view("dashboard.reports.sales");
    }

    public function purchase()
    {
        return view("dashboard.reports.purchase");
    }

    public function stock()
    {
        return view("dashboard.reports.stock");
    }
}
