<?php

namespace App\Http\Controllers\CenterEdge;

use App\CenterEdge\ApplicationInfo;
use App\Http\Resources\ApplicationInfo as ApplicationInfoResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationInfoController extends Controller
{
    public function index($database, Request $request)
    {

        return new ApplicationInfoResource(ApplicationInfo::on($database)->first());
    
    }
}
