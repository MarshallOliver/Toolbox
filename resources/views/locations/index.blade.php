@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">

			<h1>{{ __('Locations') }}</h1>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">Location</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($locations as $location)
						<tr>
							<td>{{ $location->long_name }}</td>
							<td><a href="/locations/{{ $location->id }}/edit">Edit</a></td>
							<td><a href="#" onclick="confirmDeleteLocation({{ $location->id }}, '{{ $location->long_name }}')">Delete</i></a></td>
						</tr>						
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
	
	<div class="row">
		<div class="col">

			<a href="/locations/create" class="btn btn-primary">New</a>

		</div>
	</div>

</div>

<div id="deleteLocation" class="modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete <span class="deleteLongName"></span>?</h5>
				<button type="button" class="close" onclick="closeConfirmDeleteLocation()" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to <span class="text-danger font-weight-bold">DELETE</span> the <u class="deleteLongName"></u> location?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="closeConfirmDeleteLocation()">Cancel</button>
				<form id="deleteLocationForm" action="" method="POST">
	
					@csrf
	
					@method('delete') 

					<button type="submit" class="btn btn-danger">Delete</button>

				</form>
			</div>
		</div>
	</div>
</div>

@endsection

<script>
	
	function confirmDeleteLocation(id, longName) {
		$(".deleteLongName").html(longName);
		document.getElementById("deleteLocationForm").action = '/locations/' + id;

		$('#deleteLocation').modal('toggle');
	}

	function closeConfirmDeleteLocation() {

		$('#deleteLocation').modal('toggle');

	}

</script>