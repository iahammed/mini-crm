@extends('layouts.layout')
@section('content')

    <h1>List of clients</h1>
    <div class="container">
        <ul>
        @forelse ($clients as $client)
            <li><a href="{{ $client->path() }}">{{ $client->first_name }},  {{ $client->last_name }}</a></li>
        @empty
            No clients yet
        @endforelse
        </ul>
    </div>
    {{ $clients->links() }}

@endsection