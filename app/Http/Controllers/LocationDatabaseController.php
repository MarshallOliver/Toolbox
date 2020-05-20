<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Database;

class LocationDatabaseController extends Controller
{

    public function __construct()
    {

        $location = Route::current()->parameter('location');
        $database = Route::current()->parameter('database');

        $resource = Database::where([['id', $database], ['location_id', $location]])->first();
        
        if (!$resource) {
            return abort(404);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($location_id)
    {
        return view('locations.databases.create', ['location' => $location_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $location_id)
    {
        
        $validatedRequest = $request->validate([
            'host' => 'required|ip',
            'port' => 'required|numeric|min:10|max:65535',
            'catalog' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);

        $database->host = $validatedRequest->host;
        $database->port = $validatedRequest->port;
        $database->catalog = $validatedRequest->catalog;
        $database->username = $validatedRequest->username;
        $database->password = Hash::make($validatedRequest->password);

        $database = new Database($validatedRequest);
        $database->location_id = $location_id;

        $database->save();

        return redirect('/locations/' . $location_id . '/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($location_id, $id)
    {

        return view('locations.databases.edit', ['database' => Database::with('location')->findOrFail($id),
                                                 'location' => $location_id
                                             ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $location_id, $id)
    {
        $validatedRequest = $request->validate([
            'host' => 'required|ip',
            'port' => 'required|numeric|min:10|max:65535',
            'catalog' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);

        $database = Database::findOrFail($id);
        
        $database->host = $validatedRequest['host'];
        $database->port = $validatedRequest['port'];
        $database->catalog = $validatedRequest['catalog'];
        $database->username = $validatedRequest['username'];
        $database->password = $validatedRequest['password'];

        $database->save();

        return redirect('/locations/' . $location_id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($location_id, $id)
    {
        Database::destroy($id);

        return redirect('/locations/' . $location_id . '/edit');
    }
}
