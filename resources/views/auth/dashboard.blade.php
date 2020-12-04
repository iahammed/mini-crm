@extends('layouts.layout')
@section('content')
    
<div class="row" style="padding:5px">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <h5 class="card-title">Recently added Clients</h5>
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
                    <td>{{ $client->fullname }}</td>
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
</div>

@endsection