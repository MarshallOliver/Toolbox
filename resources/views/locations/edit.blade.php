@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
		
			<h1 class="title">{{ __('Edit') }} {{ $location->long_name }}</h1>

		</div>
	</div>

	<div class="row">
		<div class="col-6">

			<form action="/locations/{{ $location->id }}" method="POST">

				@csrf

				@method('PUT')

				<div class="form-row">
					<div class="form-group col-3">

						<label for="short_name">Short Name</label>
						<input type="text" 
							name="short_name" 
							class="form-control @error('short_name') is-invalid @enderror" 
							id="short_name" 
							value="{{ $location->short_name }}" 
							required>

						@error('short_name')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror

					</div>
					<div class="form-group col">

						<label for="long_name">Long Name</label>
						<input type="text" 
							name="long_name" 
							class="form-control @error('long_name') is-invalid @enderror" 
							id="long_name" 
							value="{{ $location->long_name }}" 
							required>

						@error('long_name')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror

					</div>
				</div>
				<div class="form-row">
					<div class="form-group col">

						<label for="address1">Address 1</label>
						<input type="text" 
							name="address1" 
							class="form-control @error('address1') is-invalid @enderror" 
							id="address1" 
							value="{{ $location->address1 }}"
							required>

						@error('address1')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror

					</div>
				</div>
				<div class="form-row">
					<div class="form-group col">

						<label for="address2">Address 2</label>
						<input type="text" 
							name="address2" 
							class="form-control @error('address2') is-invalid @enderror" 
							id="address2"
							value="{{ $location->address2 }}">

						@error('address2')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror

					</div>
				</div>
				<div class="form-row">
					<div class="form-group col">

						<label for="city">City</label>
						<input type="text" 
							name="city" 
							class="form-control @error('city') is-invalid @enderror" 
							id="city" 
							value="{{ $location->city }}"
							required>

						@error('city')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror

					</div>
					<div class="form-group col">

						<label for="state">State</label>
						<input type="text" 
							name="state" 
							class="form-control @error('state') is-invalid @enderror" 
							id="state" 
							value="{{ $location->state }}"
							required>

						@error('state')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror

					</div>
					<div class="form-group col">

						<label for="zip_code">Zip Code</label>
						<input type="text" 
							pattern="^([0-9]{5}(?:-[0-9]{4})?)$" 
							name="zip_code" 
							class="form-control @error('zip_code') is-invalid @enderror" 
							id="zip_code" 
							value="{{ $location->zip_code }}" 
							required>
						
						@error('zip_code')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror

					</div>
				</div>

				<div class="row">
					<div class="col">
						<button type="submit" class="btn btn-primary">Save</button>
						<a href="/locations" class="btn btn-secondary">Cancel</a>
					</div>
				</div>

			</form>

		</div>

		<div class="col-6">
			Databases
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Database</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($location->databases as $database)
						<tr>
							<td>{{ $database->catalog }}</td>
							<td><a href="/locations/{{ $location->id }}/databases/{{ $database->id }}/edit">Edit</a></td>
							<td><a href="#" v-on:click="
								showModal(
									'{{ $database->catalog }}', 
									'/locations/{{ $location->id }}/databases/{{ $database->id }}',
									'Delete {{ $database->catalog }}?',
									'Are you sure you want to <strong class=&#34;text-danger&#34;>DELETE</strong> the <u>{{ $database->catalog }}</u> database?',
								)">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<br />

			<a href="/locations/{{ $location->id}}/databases/create" class="btn btn-primary">New</a>

		</div>

	</div>

</div>

<delete-modal v-on:hide-modal="hideModal" v-bind:modal="modal"></delete-modal>

@endsection