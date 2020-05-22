@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
		
			<h1>{{ __('DPL Generator') }}</h1>

		</div>
	</div>
	
	<form action="dpl" method="POST">
		@csrf

		<div class="row">
			<div class="col">

				<div class="form-group">
					<label for="customer_id">Customer ID</label>
					<input type="number" class="form-control" name="customer_id" value="0" />
				</div>

			</div>
			<div class="col">

				<div class="form-group">
					<label for="invoice">Invoice/Receipt #:</label>
					<input type="text" class="form-control" name="invoice" required />
				</div>

			</div>
		</div>

		<div class="card">

			<table id="dpl-table" class="table">
				<thead>
					<tr>
						<th scope="col" style="display:none;">SKU</th>
						<th scope="col">Barcode</th>
						<th scope="col">Description</th>
						<th scope="col" style="display:none;">Sales Unit</th>
						<th scope="col">Total Quantity</th>
						<th scope="col">Unit Price</th>
						<th scope="col">Tickets</th>
						<th scope="col">Count Per Unit</th>
						<th scope="col">Item Price</th>
						<th scope="col"><button id="add-row" class="btn btn-primary">Add Row</button></th>
					</tr>
				</thead>
				<tbody class="dpl-form-row">
					<tr>
						<td style="display:none;"><input name="sku[]" class="form-control" type="text" /><</td>
						<td><input name="barcode[]" class="form-control" type="text" /></td>
						<td><input name="description[]" class="form-control" type="text" maxlength="30" required /></td>
						<td style="display:none;">
							<select name="sales_unit[]" class="form-control" required>
								<option selected value="each">EACH</option>
								<option value="inner">INNER</option>
								<option value="case">CASE</option>
							</select>
						</td>
						<td><input name="total_quantity[]" class="form-control" type="number" required /></td>
						<td><input name="unit_price[]" class="form-control" type="number" step="0.01" min="0" required /></td>
						<td><input name="tickets[]" class="form-control" type="number" required /></td>
						<td><input name="count_per_unit[]" class="form-control" type="number" required /></td>
						<td><input name="item_price[]" class="form-control" type="number" step="0.01" min="0" required /></td>
						<td><button type="button" id="remove-row" class="btn btn-danger">Delete</button></td>
					</tr>
				</tbody>

			</table>

		</div>
		
		<br />

		<div class="row">
			<div class="form-group col">
				<button class="btn btn-primary" type="submit" value="submit">Submit</button>
			</div>
		</div>

	</form>

	<div class="row">
		<div class="col">

			<dl>
				<dt>SKU</dt>
				<dd>Optional - Stock number used for reordering.  If left blank, then Barcode is used instead.</dd>
				<dt>Barcode</dt>
				<dd>This is the Barcode ID that the site uses and should also be used for scanning at the point of redemption.</dd>
				<dt>Description</dt>
				<dd>This is the item description.</dd>
				<dt>Sales Unit</dt>
				<dd>This indicates whether the item was shipped as an EACH, INNER, or CASE.  If it is an EACH then the qty per unit is the same as total quantity shipped.  If the item is an INNER or CASE the quantity of sales unit will be different for total items shipped.  I.e., 10 bags of jumping frogs at 144 per INNER would have a quantity of sales unit shipped ad 10 and Total Quantity shipped as 1440.  <b>When in doubt, set to EACH and enter the price per EACH as the Unit Price.</b></dd>
				<dt>Total Quantity</dt>
				<dd>This is the total quantity of items shipped.</dd>
				<dt>Unit Price</dt>
				<dd>Price per EACH, INNER, or CASE depending upon selection.</dd>
				<dt>Tickets</dt>
				<dd>This is the Ticket value of an individual item.</dd>
				<dt>Count Per Unit</dt>
				<dd>This tells how many items are in an INNER or CASE.  If Sales Unit is EACH, this should be set to 1.</dd>
				<dt>Item Price</dt>
				<dd>This is the price per individual item.</dd>
			</dl>

		</div>
	</div>

</div>

@endsection

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js?ver=3.3.1"></script>

<script>

	$(document).ready(function() {

		var max_fields = 100;
		var wrapper = $("#dpl-table");
		var add_button = $("#add-row");
		var x = 1;

		var row = $(".dpl-form-row").html();

		$('#remove-row').prop('disabled', true);

		$(add_button).click(function(e){
			e.preventDefault();
			$('#remove-row').prop('disabled', false);
			$(wrapper).append(row);
			x++;
		});

		$(wrapper).on("click", "#remove-row", function(e){
			
			e.preventDefault();

			if(x > 1) {
				$(this).parent('td').parent('tr').remove();
				x--;
				if(x == 1) {
					$('#remove-row').prop('disabled', true);
				}
			} else {
				alert('You cannot remove the last row!');
			}
			
		});

	});

</script>
