<?php

namespace App\Http\Controllers\CenterEdge;

use App\CenterEdge\GroupAreaBooking;
use App\Http\Resources\GroupAreaBookingCollection;
use App\Http\Resources\GroupAreaBooking as GroupAreaBookingResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupAreaBookingController extends Controller
{
    public function index($database, Request $request)
    {

        return new GroupAreaBookingCollection(GroupAreaBooking::on($database)->with('arrival')->take($request->limit['areas'] ?? 100)->where($request->filter)->get());
    
    }
}
