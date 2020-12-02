@extends('layouts.layout')
@section('content')
    
<div class="row" style="padding:5px">
    <div class="card" style="width: 55%;">
        <div class="card-body">
            <h5 class="card-title">Recently Added of clients</h5>
        </div>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col"># Trans</th>
                    <th scope="col">Balance</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td >{{ $client->fullname }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->transactions_count }}</td>
                    <td>{{ $client->transactions_sum_amount }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="No data to display"></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="width: 3%;">&nbsp;</div>
    <div class="card" style="width: 40%;">
        <div class="card-body">
            <h5 class="card-title">List of Recently Added Transactions</h5>
        </div>

        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">Date</th>
                    <th scope="col">Client</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ $transaction->client->fullname }}</td>
                    <td>{{ $transaction->amount }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="No data to display"></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection