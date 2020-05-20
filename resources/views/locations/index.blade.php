@extends('layouts.main')

@section('title', 'Locations')

@section('content')

<div class="section">
	<div class="container">

		<h1 class="title">Locations</h1>

		<table id="table" width="100%">
			<thead>
				<tr>
					<th>Location</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
			 	@foreach ($locations as $location)
					<tr>
						<td>{{ $location->long_name }}</td>
						<td><a href="/locations/{{ $location->id }}/edit"><i class="far fa-edit"></i></a></td>
						<td><a href="#" onclick="confirmDeleteLocation({{ $location->id }}, '{{ $location->long_name }}')"><i class="far fa-trash-alt"></i></a></td>
					</tr>
				@endforeach
		 	</tbody>
		</table>

		<br />

		<a href="/locations/create" class="button">New</a>

	</div>
</div>

<div id="deleteLocation" class="modal">
	<div class="modal-background" onclick="closeConfirmDeleteLocation()"></div>
	<div class="modal-content">
		<div class="box has-text-centered">
			Are you sure you want to <span class="has-text-danger has-text-weight-bold">DELETE</span> the <span id="deleteLongName" class="has-text-weight-bold" style="text-decoration: underline;"></span> location?

			<br /><br />

			<form id="deleteLocationForm" action="" method="POST">

				@csrf

				@method('delete')

				<div class="field is-grouped is-grouped-centered">

					<p class="control">
						<button type="submit" class="button is-light">
							Confirm
						</button>
					</p>
					<p class="control">
						<a class="button is-primary" onclick="closeConfirmDeleteLocation()">
							Cancel
						</a>
					</p>

				</div>

			</form>

		</div>
	</div>
</div>

<script>
	
	function confirmDeleteLocation(id, longName) {
		document.getElementById("deleteLongName").innerHTML = longName;
		document.getElementById("deleteLocationForm").action = '/locations/' + id;

		document.getElementById("deleteLocation").classList.add("is-active");
	}

	function closeConfirmDeleteLocation() {
		document.getElementById("deleteLocation").classList.remove("is-active");
	}

</script>

@endsection