@extends('layouts.layout')
@section('content')

<div class="card" style="width:400px">
  <img class="card-img-top" src="{{ $client->photopath() }}" alt="Card image">
  <div class="card-body">
    <h4 class="card-title">{{ $client->first_name }} {{ $client->last_name }}</h4>
    <p class="card-text">{{ @$client->email }}</p>
    <p class="card-text">Balance : {{ @$client->currentBalance() ? 'No transaction yet' :  $client->currentBalance() }}</p>
    <a href="#" class="btn btn-primary">List of transactions</a>
  </div>
</div>

@endsection

