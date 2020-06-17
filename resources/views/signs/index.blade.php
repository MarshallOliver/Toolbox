@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">

			<h1>{{ __('Signs') }}</h1>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">Sign</th>
						<th scope="col">Type</th>
						<th scope="col">Location</th>
						<th scope="col">Database</th>
						<th scope="col">View</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($signs as $sign)
						<tr>
							<td>{{ $sign->name }}</td>
							<td>{{ $sign->signType->name }}</td>
							<td>{{ $sign->database->location->long_name }}</td>
							<td>{{ $sign->database->catalog }}</td>
							<td><a href="/signs/{{ $sign->id }}">View</a></td>
							<td><a href="/signs/{{ $sign->id }}/edit">Edit</a></td>
							<td><a href="#" v-on:click="
								showModal(
									'{{ $sign->name }}', 
									'/signs/{{ $sign->id }}',
									'Delete {{ $sign->name }}?',
									'Are you sure you want to <strong class=&#34;text-danger&#34;>DELETE</strong> the <u>{{ $sign->name }}</u> sign?',
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

			<a href="/signs/create" class="btn btn-primary">New</a>

		</div>
	</div>

</div>

<utility-delete-modal v-on:hide-modal="hideModal" v-bind:modal="modal"></utility-delete-modal>

@endsection