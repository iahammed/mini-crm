@extends('layouts.layout')
@section('content')

    <h1>List of Transactions</h1>
    <div class="container">
        <ul>
        @forelse ($transactions as $transaction)
            <li>
                <a href="{{ $transaction->path() }}">{{ $transaction->client->first_name }} {{ $transaction->client->last_name }}, Trans Amount : {{ $transaction->amount }},  {{ $transaction->client->first_name }}</a>
            </li>
        @empty
            No Transactions
        @endforelse
        </ul>
    </div>
    {{ $transactions->links() }}
@endsection