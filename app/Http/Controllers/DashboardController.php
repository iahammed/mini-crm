<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions =  Transaction::latest()->limit(10)->get();

        $clients = Client::withCount('transactions')
                            ->withSum('transactions', 'amount')
                            ->latest()
                            ->limit(10)
                            ->get();
        return view('auth.dashboard',compact('clients','transactions'));
    }
}
