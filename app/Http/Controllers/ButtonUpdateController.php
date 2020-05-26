<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ButtonUpdateController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function index()
    {
    	return view('tools.button_updates');
    }

    public function execute(Request $request)
    {
    	
    }
}
