@extends('layouts.layout')
@section('content')

    <h1>List of Transactions</h1>
    <ul>
    @forelse($transactions as $transaction )
        <li><a href="{{ $transaction->path() }}">{{ $transaction->amount }}, {{ $transaction->transaction_date }}, {{ $transaction->client_id }}</a></li>
    @empty
        No Client yet
    @endforelse
    </ul>
@endsection