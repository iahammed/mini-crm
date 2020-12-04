@extends('layouts.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class = "row">
                <div class="col-11">
                    <h5 class="card-title">List of Transactions</h5>
                </div>
                <div class="col-1">
                    <a class="btn btn-success" 
                            href="{{ route('transaction.create') }}" 
                            title="Create a project"> 
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="justify-content-center">
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <td>#</td>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                    <tr>
                        <td></td>
                        <td>{{ $transaction->client->fullname }} </td>
                        <td>{{ $transaction->transaction_date }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>
                            <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST">
                                <a href="{{ route('transaction.show', $transaction->id) }}" title="show">
                                    <i class="fas fa-eye text-success  fa-lg"></i>
                                </a>
                                <a href="{{ route('transaction.edit', $transaction->id) }}">
                                    <i class="fas fa-edit  fa-lg"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                    <i class="fas fa-trash fa-lg text-danger"></i>

                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan = "5">No data to display</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="justify-content-center">
            {{ $transactions->links() }}
        </div>
    </div>

@endsection