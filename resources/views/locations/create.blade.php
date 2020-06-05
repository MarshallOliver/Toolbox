@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
		
			<h1 class="title">{{ __('Add a Location') }}</h1>

		</div>
	</div>

	<form action="/locations" method="POST">

		@csrf

		<div class="form-row">
			<div class="form-group col-3">
				<label for="short_name">Short Name</label>
				<input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror" id="short_name" required>
				@error('short_name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="form-group col">
				<label for="long_name">Long Name</label>
				<input type="text" name="long_name" class="form-control @error('long_name') is-invalid @enderror" id="long_name" required>
				@error('long_name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col">
				<label for="address1">Address 1</label>
				<input type="text" name="address1" class="form-control @error('address1') is-invalid @enderror" id="address1" required>
				@error('address1')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col">
				<label for="address2">Address 2</label>
				<input type="text" name="address2" class="form-control @error('address2') is-invalid @enderror" id="address2">
				@error('address2')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col">
				<label for="city">City</label>
				<input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="city" required>
				@error('city')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="form-group col">
				<label for="state">State</label>
				<input type="text" name="state" class="form-control @error('state') is-invalid @enderror" id="state" required>
				@error('state')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="form-group col">
				<label for="zip_code">Zip Code</label>
				<input type="text" pattern="^([0-9]{5}(?:-[0-9]{4})?)$" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" required>
				@error('zip_code')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
		</div>

		<div class="row">
			<div class="col">
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>

	</form>

</div>
	
@endsection