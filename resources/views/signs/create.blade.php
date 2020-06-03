@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>{{ __('Add a Database') }}</h1>
		</div>
	</div>
	<form action="/locations/{{ $location->id }}/databases" method="POST">

		@csrf

		<div class="form-row">

			<div class="form-group col">
				<label for="location">Location</label>
				<select name="location" class="form-control @error('location') is-invalid @enderror">
					<option disabled selected>Select a Location</option>
					@foreach ($locations as $location)
						<option value="{{ $location->id }}">{{$location->long_name }}</option>
					@endforeach
				</select>
				@error('location')
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