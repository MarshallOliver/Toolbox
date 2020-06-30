<?php

namespace App\Http\Controllers\CenterEdge;

use App\CenterEdge\MessageLog;
use App\Http\Resources\MessageLogCollection;
use App\Http\Resources\MessageLog as MessageLogResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageLogController extends Controller
{
    public function index($database, Request $request)
    {

    	return new MessageLogCollection(MessageLog::on($database)->where($request->filter)->orderBy('MsgDateTime', 'desc')->paginate(50)->withQueryString());

    }
}
