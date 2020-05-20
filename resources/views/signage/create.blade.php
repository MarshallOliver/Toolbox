@extends('layouts.main')

@section('title', 'Locations')

@section('content')

<div class="section">
	<div class="container">

		<h1 class="title">Create a Sign</h1>

		<form action="/signage" method="POST">

			@csrf

			<div class="columns">

				<div class="column">
	
					<div class="field">
						<label class="label">Name</label>
						<div class="control">
							<input class="input" type="text" name="name" placeholder="A Fancy Sign" required>
						</div>
					</div>

				</div>

				<div class="column">

					<div class="field">
						<label class="label">Location</label>
						<div class="control">
							<div class="select is-fullwidth">
								<select id="locationSelect" required>

									<option disabled selected>Select a Location</option>
									
									@foreach ($locations as $location)
						
										<option value="{{ $location->id }}">{{ $location->long_name }}</option>

									@endforeach

								</select>
							</div>
						</div>
					</div>

				</div>

				<div class="column">

					<div class="field">
						<label class="label">Database</label>
						<div class="control">
							<div class="select is-fullwidth">
								<select id="databaseSelect" name="database_id" disabled required>
									<option>Select a Location</option>
								</select>
							</div>
						</div>
					</div>

				</div>

			</div>

			<div class="columns">
				<div class="column">
					<div class="field">
						<label class="label">Description</label>
						<div class="control">
							<input class="input" type="text" name="details" placeholder="Give me a description!" required>

						</div>
					</div>
				</div>
			</div>

			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-primary">Submit</button>
				</div>
				<div class="control">
					<a href="/signage" class="button is-light">Cancel</a>
				</div>
			</div>

		</form>

	</div>
</div>

<script>

	const databases = [];
	@foreach ($locations as $location)
		databases["{{ $location->id }}"] = @foreach ($location->databases as $database)"<option value='{{ $database->id }}'>{{ $database->catalog }}</option>" + @endforeach""
	@endforeach

	document.addEventListener('input', function(event) {

		if (event.target.id !== 'locationSelect') return;

		let location = document.getElementById("locationSelect").value;
		let databaseSelect = document.getElementById("databaseSelect");

		databaseSelect.innerHTML = databases["" + location + ""];
		databaseSelect.disabled = false;

	}, false);

</script>
	
@endsection