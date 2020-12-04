@extends('layouts.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class = "row">
                <div class="col-11">
                    <h5 class="card-title">List of clients</h5>
                </div>
                <div class="col-1">
                    <a class="btn btn-success" 
                            href="{{ route('client.create') }}" 
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
                        <th></th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th>Balance</th>
                        <th>Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                    <tr>
                        <td>
                            <img src = "{{ $client->photopath() }}" alt = "{{ $client->first_name }}" width = "60" height = "60" >
                        </td>
                        <td>{{ $client->fullname }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->currentBalance() }}</td>
                        <td>
                            <form action="{{ route('client.destroy', $client->id) }}" method="POST">
                                <a href="{{ route('client.show', $client->id) }}" title="show">
                                    <i class="fas fa-eye text-success  fa-lg"></i>
                                </a>
                                <a href="{{ route('client.edit', $client->id) }}">
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
            {{ $clients->links() }}
        </div>
    </div>

@endsection