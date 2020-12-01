@extends('layouts.layout')
@section('content')
{{ $transaction->client->first_name }}
{{ $transaction->transaction_date }}
{{ $transaction->amount }}
@endsection

