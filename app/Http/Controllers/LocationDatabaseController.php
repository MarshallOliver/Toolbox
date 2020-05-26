<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Database;

class LocationDatabaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Location $location)
    {
        return view('locations.databases.create', ['location' => $location]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, \App\Location $location)
    {
        $validatedRequest = $request->validate([
            'host' => 'required|ip',
            'port' => 'required|numeric|min:10|max:65535',
            'catalog' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);

        $database = new Database;

        $database->location_id = $location->id;
        $database->host = $validatedRequest['host'];
        $database->port = $validatedRequest['port'];
        $database->catalog = $validatedRequest['catalog'];
        $database->username = $validatedRequest['username'];
        $database->password = encrypt($validatedRequest['password']);

        $database->save();

        return redirect('/locations/' . $location->id . '/edit');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Location $location, \App\Database $database)
    {
        return view('locations.databases.edit', ['database' => $database,

                                             ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Location $location, \App\Database $database)
    {
        $validatedRequest = $request->validate([
            'host' => 'required|ip',
            'port' => 'required|numeric|min:10|max:65535',
            'catalog' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);

        $database = Database::findOrFail($database->id);

        $database->host = $validatedRequest['host'];
        $database->port = $validatedRequest['port'];
        $database->catalog = $validatedRequest['catalog'];
        $database->username = $validatedRequest['username'];
        $database->password = encrypt($validatedRequest['password']);

        $database->save();

        return redirect('/locations/' . $location->id . '/edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Location $location, \App\Database $database)
    {
        Database::destroy($database->id);

        return redirect('/locations/' . $location->id . '/edit');
    }
}
