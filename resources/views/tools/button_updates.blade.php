@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">

			<h1>Button Updates</h1>

		</div>
	</div>
	<div class="row">
		<div class="col">
			@if ($result ?? '')
				dd($result)
			@endif
		</div>
	</div>

	<form action="/button-updates" method="POST">

	@csrf

		<div class="form-row">
			<div class="form-group col">
				<label for="location">Location</label>
				<select name="location" id="location" class="form-control @error('location') is-invalid @enderror">
					<option disabled selected>Select a Location</option>
					@foreach ($locations as $location)
						<option value="{{ $location->id }}">{{ $location->long_name }}</option>
					@endforeach
				</select>
				@error('location')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="form-group col">
				<label for="database">Database</label>
				<select name="database" id="database" class="form-control @error('database') is-invalid @enderror" disabled>
					<option disabled selected>Select a Location</option>
				</select>
			</div>

		</div>

		<button type="submit" class="btn btn-danger">Execute</button>

	</form> 
</div>

@endsection

<script>

	const databases = [];
	@foreach ($locations as $location)
		databases["{{ $location->id }}"] = @foreach ($location->databases as $database)"<option value=' {{ $database->id }}'>{{ $database->catalog }}</option>" + @endforeach"";
	@endforeach

	document.addEventListener('input', function(event) {
		if (event.target.id !== "location") return;
		let location = document.getElementById("location").value;
		let database = document.getElementById("database");
		database.innerHTML += databases["" + location + ""];
		database.disabled = false;
	}, false);

</script>