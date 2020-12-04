<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(10);
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data
        $validatedData = $request->validate([
            'first_name'    => ['required', 'max:50'],
            'last_name'     => ['required', 'max:50'],
            'email'         => ['required', 'email', 'unique:clients'],
            'avatar'        => ['required', 'file','dimensions: min_width = 100, min_height = 100'],
            // 'avatar'        => ['required'],
        ]);
        $validatedData['avatar'] = request('avatar')->store('public');
        $data = Client::create($validatedData);

        return redirect()->route('client.index')
            ->with('success', 'Client created successfully.')
            ->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('client.detail', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'first_name'    => ['max:50'],
            'last_name'     => ['max:50'],
            'email'         => ['email'],
            // 'avatar'        => ['required', 'file','dimensions: min_width = 100, min_height = 100'],
            // 'avatar'        => ['required'],
        ]);
        $client->update($validatedData);

        return redirect()->route('client.index')
            ->with('success', 'Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        Storage::delete($client->avatar);
        $client->delete();
        return redirect()->route('client.index')
            ->with('success', 'Client deleted successfully');
    }
}
