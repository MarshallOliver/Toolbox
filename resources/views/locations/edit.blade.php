@extends('layouts.main')

@section('title', 'Locations')

@section('content')

<div class="section">
	<div class="container">

		<h1 class="title">{{ $location->long_name }}</h1>

		<div class="columns">
			<div class="column is-half">

				<form action="/locations/{{ $location->id }}" method="POST">

					@csrf

					@method('PUT')

					<div class="columns">
						<div class="column is-one-quarter">
							<div class="field">
								<label class="label">Short Name</label>
								<div class="control">
									<input name ="short_name" class="input @error('short_name') is-danger @enderror" type="text" value="{{ $location->short_name }}" required>
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
									<input name="long_name" class="input @error('long_name') is-danger @enderror" type="text" value="{{ $location->long_name }}" required>
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
							<input name="address1" class="input" type="text" value="{{ $location->address1 }}" required>
						</div>
						@error('address1')
							<p class="help is-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="field">
						<label class="label">Address 2</label>
						<div class="control">
							<input name="address2" class="input" type="text" value="{{ $location->address2 }}">
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
									<input name="city" class="input" type="text" value="{{ $location->city }}" required>
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
									<input name="state" class="input" type="text" value="{{ $location->state }}" required>
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
									<input name="zip_code" class="input" type="text" pattern="^(\d{5}(?:\-\d{4})?)$" value="{{ $location->zip_code }}" required>
								</div>
								@error('zip_code')
									<p class="help is-danger">{{ $message }}</p>
								@enderror
							</div>

						</div>

					</div>

					<div class="field is-grouped is-grouped-right">
						<div class="control">
							<button type="submit" class="button is-primary">Save</button>
						</div>
						<div class="control">
							<a href="/locations" class="button is-light">Cancel</a>
						</div>
					</div>

				</form>
	
			</div>

			<div class="column is-half">

				<table id="table" width="100%">
				 	<thead>
				 		<tr>
				 			<th>Database</th>
				 			<th>Edit</th>
				 			<th>Delete</th>
				 		</tr>
				 	</thead>
				 	<tbody>
					 	@foreach ($location->databases as $database)
							<tr>
								<td>{{ $database->catalog }}</td>
								<td><a href="/locations/{{ $location->id }}/databases/{{ $database->id }}/edit"><i class="far fa-edit"></i></a></td>
								<td><a href="#" onclick="confirmDeleteDatabase({{ $database->id }}, '{{ $database->catalog }}')"><i class="far fa-trash-alt"></i></a></td>
							</tr>
						@endforeach
				 	</tbody>
				</table>

				<br />

				<a href="/locations/{{ $location->id }}/databases/create" class="button">New</a>
			</div>

		</div>

	</div>
</div>

<div id="deleteDatabase" class="modal">
	<div class="modal-background" onclick="closeConfirmDeleteDatabase()"></div>
	<div class="modal-content">
		<div class="box has-text-centered">
			Are you sure you want to <span class="has-text-danger has-text-weight-bold">DELETE</span> the <span id="deleteCatalog" class="has-text-weight-bold" style="text-decoration: underline;"></span> catalog?

			<br /><br />

			<form id="deleteDatabaseForm" action="" method="POST">

				@csrf

				@method('delete')

				<div class="field is-grouped is-grouped-centered">

					<p class="control">
						<button type="submit" class="button is-light">
							Confirm
						</button>
					</p>
					<p class="control">
						<a class="button is-primary" onclick="closeConfirmDeleteDatabase()">
							Cancel
						</a>
					</p>

				</div>

			</form>

		</div>
	</div>
</div>

<script>
	
	function confirmDeleteDatabase(id, catalog) {
		document.getElementById("deleteCatalog").innerHTML = catalog;
		document.getElementById("deleteDatabaseForm").action = '/locations/{{ $location->id }}/databases/' + id;

		document.getElementById("deleteDatabase").classList.add("is-active");
	}

	function closeConfirmDeleteDatabase() {
		document.getElementById("deleteDatabase").classList.remove("is-active");
	}

</script>
	
@endsection