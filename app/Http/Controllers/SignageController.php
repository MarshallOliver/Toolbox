<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Signage;

class SignageController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('signage.index', ['locations' => Location::orderBy('long_name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('signage.create', ['locations' => \App\Location::with('databases')->orderBy('long_name', 'asc')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedRequest = $request->validate([
            'name' => 'required',
            'details' => 'required',
            'database_id' => 'required',

        ]);

        $signage = new Signage($validatedRequest);

        $signage->save();

        return redirect('/signage');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Signage::destroy($id);

        return redirect('/signage');
    }
}