<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Client;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions =  Transaction::paginate(10);
        return view('transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        // check if the client model have value
        if(empty($clients->first())){
            return redirect()->route('client.create')
            ->withErrors(['client' => 'Please add atleast one client to have transaction']);
        }
        return view('transaction.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validatedData = $request->validate([
            'client_id'         => ['required', 'max:50'],
            'transaction_date'  => ['required', 'max:50'],
            'amount'            => ['required', 'numeric'],
        ]);
        $validatedData['amount'] = $this->validateTransactionAmount($request->submit, $request->client_id, $request->amount);
        Transaction::create($validatedData);
        return redirect ('/transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transaction.detail', ['transaction' => $transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $clients = Client::all();
        return view('transaction.edit', compact('transaction', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validatedData = $request->validate([
            'client_id'         => ['required', 'max:50'],
            'transaction_date'  => ['required', 'max:50'],
            'amount'            => ['required', 'numeric'],
        ]);

        $validatedData['amount'] = $this->validateTransactionAmount($request->submit, $request->client_id, $request->amount);
        $transaction->update($validatedData);
        return redirect()->route('transaction.index')
            ->with('success', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaction.index')
            ->with('success', 'Transaction deleted successfully');

    }
    /**
     * @param str $action
     * @param int $client
     * @param number $amount
     * @return redirection 
     * @return number $amount 
     */
    public function validateTransactionAmount($action, $client, $amount)
    {
        if($action === "Withdraw"){
            if((Client::findOrFail($client)->currentBalance() - $amount) < 0 ){
                return back()->withErrors(['amount' => 'Not enough fund']); 
            }
            return $validatedData['amount'] = - $validatedData['amount'];
        }
        return $amount;
    }
    /**
     * spa(auth:sanctum) returns 
     * @return json
     */
    public function apiindex()
    {
        return $transactions =  Transaction::all();
    }

}
