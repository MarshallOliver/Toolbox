@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="row">
			<div class="col">
				<h1>{{ __('Edit') }} {{ $location->long_name }}</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-6">

				@include('locations.form', ['action' => '/locations/' . $location->id, 'method' => 'PUT'])

			</div>

			<div class="col-6">
				Databases
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Database</th>
							<th scope="col">Message Log</th>
							<th scope="col">Edit</th>
							<th scope="col">Delete</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($location->databases as $database)
						<tr>
							<td>{{ $database->catalog }}</td>
							<td><a href="/locations/{{ $location->id }}/databases/{{ $database->id }}/log">{{ __('Message Log') }}</a></td>
							<td><a href="/locations/{{ $location->id }}/databases/{{ $database->id }}/edit">{{ __('Edit') }}</a></td>
							<td><a href="#" v-on:click="
								showModal(
									'{{ $database->catalog }}', 
									'/locations/{{ $location->id }}/databases/{{ $database->id }}',
									'Delete {{ $database->catalog }}?',
									'Are you sure you want to <strong class=&#34;text-danger&#34;>DELETE</strong> the <u>{{ $database->catalog }}</u> database?',
								)">{{ __('Delete') }}</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<br />
				<a href="/locations/{{ $location->id}}/databases/create" class="btn btn-primary">New</a>
			</div>

		</div>

		<utility-delete-modal v-on:hide-modal="hideModal" v-bind:modal="modal"></utility-delete-modal>

	</div>

@endsection