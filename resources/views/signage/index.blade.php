@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="section">
	<div class="container">

		<h1 class="title">Signage</h1>

		<table id="table" width="100%">
			<thead>
				<tr>
					<th>Location</th>
					<th>Database</th>
					<th>Signage</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($locations as $location)

					@foreach ($location->databases as $database)

						@foreach ($database->signage as $signage)

							<tr>

								<td>{{ $location->long_name }}</td>
								<td>{{ $database->catalog }}</td>
								<td>{{ $signage->name }}</td>
								<td><a href="/signage/{{ $signage->id }}/edit"><i class="far fa-edit"></i></a></td>
								<td><a href="#" onclick="confirmDeleteSignage({{ $signage->id }}, '{{ $signage->name }}')"><i class="far fa-trash-alt"></i></a></td>

							</tr>

						@endforeach

					@endforeach

				@endforeach
			
			</tbody>
		</table>

		<br />

		<a href="/signage/create" class="button">New</a>

	</div>
</div>

<div id="deleteSignage" class="modal">
	<div class="modal-background" onclick="closeConfirmDeleteSignage()"></div>
	<div class="modal-content">
		<div class="box has-text-centered">
			Are you sure you want to <span class="has-text-danger has-text-weight-bold">DELETE</span> the following signage?
			<br /><br />

			<span id="deleteName" class="has-text-weight-bold" style="text-decoration: underline;"></span>

			<br /><br />

			<form id="deleteSignageForm" action="" method="POST">

				@csrf

				@method('delete')

				<div class="field is-grouped is-grouped-centered">

					<p class="control">
						<button type="submit" class="button is-light">
							Confirm
						</button>
					</p>
					<p class="control">
						<a class="button is-primary" onclick="closeConfirmDeleteSignage()">
							Cancel
						</a>
					</p>

				</div>

			</form>

		</div>
	</div>
</div>

<script>
	
	function confirmDeleteSignage(id, name) {
		document.getElementById("deleteName").innerHTML = name;
		document.getElementById("deleteSignageForm").action = '/signage/' + id;

		document.getElementById("deleteSignage").classList.add("is-active");
	}

	function closeConfirmDeleteSignage() {
		document.getElementById("deleteSignage").classList.remove("is-active");
	}

</script>

@endsection