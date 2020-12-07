<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Transaction;

use Laravel\Sanctum\HasApiTokens;

class DashboardController extends Controller
{
    public function index()
    {
        $clients = Client::activity(10)->get();
        return view('auth.dashboard',compact('clients'));
    }
    
    /**
     * spa(auth:sanctum) returns 
     * @return json
     */
    public function apiindex()
    {
        $clients = Client::activity(10)->get();
        return $clients;
    }
}
