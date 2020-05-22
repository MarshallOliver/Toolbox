<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DPLController extends Controller
{
    public function generate(Request $request)
    {

    	$customer_id = $request->customer_id;
    	$invoice = $request->invoice;
    	$barcode = $request->barcode;
    	$description = $request->description;
    	$sales_unit = $request->sales_unit;
    	$total_quantity = $request->total_quantity;
    	$unit_price = $request->unit_price;
    	$tickets = $request->tickets;
    	$count_per_unit = $request->count_per_unit;
    	$item_price = $request->item_price;
    	$sku = $request->sku;

    	$filename = 'CustomDPL.csv';
    	$fp = fopen('php://output', 'w');

    	$list = array(
    		array($customer_id, $invoice),
    	);

    	for ($pos = 0; $pos < count($description); $pos++) {

    		array_push($list, array($barcode[$pos], $description[$pos], $sales_unit[$pos], $total_quantity[$pos], $unit_price[$pos], $tickets[$pos], $count_per_unit[$pos], $item_price[$pos], '', $sku[$pos]));
    	}

		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);


		foreach($list as $line) {
			fputcsv($fp, $line);
		}

	}
}
