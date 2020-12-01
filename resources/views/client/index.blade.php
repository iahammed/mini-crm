@extends('layouts.layout')
@section('content')

    <h1>List of clients</h1>
    <ul>
    @forelse($clients as $client )
        <li><a href="{{ $client->path() }}">{{ $client->first_name }}</a></li>
    @empty
        No Client yet
    @endforelse
    </ul>
@endsection