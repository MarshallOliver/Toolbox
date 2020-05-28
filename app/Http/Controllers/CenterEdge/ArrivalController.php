<?php

namespace App\Http\Controllers\CenterEdge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ArrivalCollection;
use App\Http\Resources\Arrival as ArrivalResource;
use App\CenterEdge\Arrival;

class ArrivalController extends Controller
{
    public function index(Request $request)
    {
    	$result = new ArrivalCollection(Arrival::on($request->database)->with('areas')->take(5)->get());

    	dd($result);
    }

    public function show($arrival, Request $request)
    {
    	return new ArrivalResource(Arrival::on($request->database)->findOrFail($arrival));
    }
}