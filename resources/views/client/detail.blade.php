@extends('layouts.layout')
@section('content')
{{ $client->first_name }}
{{ $client->last_name }}
{{ $client->email }}
{{ $client->avatar }}
@endsection

