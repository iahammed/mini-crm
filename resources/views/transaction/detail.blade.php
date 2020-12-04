@extends('layouts.layout')
@section('content')
<div class="card" style="width:400px">
  <div class="card-body">
    <h4 class="card-title">{{ $transaction->client->first_name }} {{ $transaction->client->last_name }}</h4>
    <p class="card-text">{{ $transaction->transaction_date }}</p>
    <p class="card-text">{{ $transaction->amount }}</p>
    <p class="card-text">Balance :  {{ $transaction->client->currentBalance() }}</p>
    <a href="#" class="btn btn-primary">List of transactions</a>
    
  </div>
</div>

@endsection

