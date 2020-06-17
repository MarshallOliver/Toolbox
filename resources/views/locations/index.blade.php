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
							<td><a href="#" v-on:click="
								showModal(
									'{{ $location->long_name }}', 
									'/locations/{{ $location->id }}',
									'Delete {{ $location->long_name }}?',
									'Are you sure you want to <strong class=&#34;text-danger&#34;>DELETE</strong> the <u>{{ $location->long_name }}</u> location?',
								)">Delete</a>
							</td>
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

<utility-delete-modal v-on:hide-modal="hideModal" v-bind:modal="modal"></utility-delete-modal>

@endsection