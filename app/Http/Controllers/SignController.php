<?php

namespace App\Http\Controllers;

use App\Sign;
use Illuminate\Http\Request;

class SignController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $signs = Sign::with('database.location')->orderBy('name', 'asc')->get();

        return view('signs.index', ['signs' => $signs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = \App\Location::with('databases')->get();
        $signTypes = \App\SignType::all();

        return view('signs.create', [
            'locations' => $locations,
            'signTypes' => $signTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedSign = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'database' => 'required|numeric',
            'sign_type' => 'required|numeric',

        ]);

        $sign = new Sign;

        $sign->name = $validatedSign['name'];
        $sign->database_id = $validatedSign['database'];
        $sign->sign_type_id = $validatedSign['sign_type'];

        $sign->save();

        $validatedArea = $request->validate([
            'area' => 'required',

        ]);

        $sign->signArea()->create([
            'area_guid' => $validatedArea['area'],
        ]);

        return redirect('signs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sign  $sign
     * @return \Illuminate\Http\Response
     */
    public function show(Sign $sign)
    {
        if ($sign->sign_type_id == 1) {
            return view('signs.roomcards.index', ['sign' => $sign]);
        } else {
            dd('Something went wrong...');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sign  $sign
     * @return \Illuminate\Http\Response
     */
    public function edit(Sign $sign)
    {

        $locations = \App\Location::with('databases')->get();
        $signTypes = \App\SignType::all();

        return view('signs.edit', ['sign' => $sign,
                                    'locations' => $locations,
                                    'signTypes' => $signTypes,
                                    
                                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sign  $sign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sign $sign)
    {

        $validatedSign = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'database' => 'required|numeric',
            'sign_type' => 'required|numeric',

        ]);

        $sign->name = $validatedSign['name'];
        $sign->database_id = $validatedSign['database'];
        $sign->sign_type_id = $validatedSign['sign_type'];

        $validatedArea = $request->validate([
            'area' => 'required',

        ]);

        $sign->signArea->area_guid = $validatedArea['area'];

        $sign->push();

        return redirect('signs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sign  $sign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sign $sign)
    {
        $sign->delete();

        return redirect('signs');
    }
}
