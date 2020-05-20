@extends('layouts.main')

@section('title', 'Locations')

@section('content')

<div class="section">
	<div class="container">

		<h1 class="title">Add a Location</h1>

		<form action="/locations" method="POST">

			@csrf

			<div class="columns">
				<div class="column is-one-quarter">
					<div class="field">
						<label class="label">Short Name</label>
						<div class="control">
							<input name ="short_name" class="input @error('short_name') is-danger @enderror" type="text" placeholder="ORL" required>
						</div>
						@error('short_name')
							<p class="help is-danger">{{ $message }}</p>
						@enderror
					</div>
				</div>

				<div class="column">

					<div class="field">
						<label class="label">Long Name</label>
						<div class="control">
							<input name="long_name" class="input @error('long_name') is-danger @enderror" type="text" placeholder="Orlando" required>
						</div>
						@error('long_name')
							<p class="help is-danger">{{ $message }}</p>
						@enderror
					</div>
				</div>
			</div>

			<div class="field">
				<label class="label">Address 1</label>
				<div class="control">
					<input name="address1" class="input" type="text" placeholder="123 Sesame St" required>
				</div>
				@error('address1')
					<p class="help is-danger">{{ $message }}</p>
				@enderror
			</div>

			<div class="field">
				<label class="label">Address 2</label>
				<div class="control">
					<input name="address2" class="input" type="text" placeholder="Suite 123">
				</div>
				@error('address2')
					<p class="help is-danger">{{ $message }}</p>
				@enderror
			</div>

			<div class="columns">
				<div class="column">

					<div class="field">
						<label class="label">City</label>
						<div class="control">
							<input name="city" class="input" type="text" placeholder="Orlando" required>
						</div>
						@error('city')
							<p class="help is-danger">{{ $message }}</p>
						@enderror
					</div>

				</div>

				<div class="column">

					<div class="field">
						<label class="label">State</label>
						<div class="control">
							<input name="state" class="input" type="text" placeholder="FL" required>
						</div>
						@error('state')
							<p class="help is-danger">{{ $message }}</p>
						@enderror
					</div>

				</div>

				<div class="column">

					<div class="field">
						<label class="label">Zip Code</label>
						<div class="control">
							<input name="zip_code" class="input" type="text" pattern="^(\d{5}(?:\-\d{4})?)$" placeholder="12345" required>
						</div>
						@error('zip_code')
							<p class="help is-danger">{{ $message }}</p>
						@enderror
					</div>

				</div>

			</div>

			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-primary">Submit</button>
				</div>
				<div class="control">
					<a href="/locations" class="button is-light">Cancel</a>
				</div>
			</div>

		</form>

	</div>
</div>
	
@endsection