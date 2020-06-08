@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>{{ __('Add a Sign') }}</h1>
		</div>
	</div>
	<form action="/signs" method="POST">

		@csrf

		<div class="form-row">
			<div class="form-group col">
				<label for="name">Description</label>
				<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter a Description">
				@error('name')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
		</div>

		<div class="form-row">

			<div class="form-group col">
				<label for="location">Location</label>
				<select v-model="selectedLocation" v-on:change="resetSelectedDatabase" name="location" id="location" class="form-control @error('location') is-invalid @enderror">
					<option value="0" disabled>Select a Location</option>
					@foreach ($locations as $location)
						<option v-bind:value="{ databases: {{ $location->databases }} }">{{$location->long_name }}</option>
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
				<select v-model="selectedDatabase" name="database" id="database" class="form-control @error('database') is-invalid @enderror" v-bind:disabled="selectedLocation == 0">
					<option value="0" disabled>Select a Database</option>
					<option v-for="database in selectedLocation.databases" v-bind:value="database.id">@{{ database.catalog }}</option>
				</select>
				@error('database')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
		
		</div>

		<div class="form-row">

			<div class="form-group col">
				<label for="sign_type">Sign Type</label>
				<select v-model="selectedSignType" v-on:change="loadSignType" name="sign_type" id="sign_type" class="form-control @error('sign_type') is-invalid @enderror" v-bind:disabled="selectedDatabase == 0">
					<option value="0" disabled>Select a Sign Type</option>
					@foreach ($signTypes as $signType)
						<option v-bind:value="{{ $signType->id }}">{{ $signType->name }}</option>
					@endforeach
				</select>
				@error('sign_type')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

		</div>

		{{-- If the selected sign type is 'Room Card' --}}

		<div v-if="loading" class="d-flex align-items-center">
		  <strong>Loading...</strong>
		  <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
		</div>

		<div v-if="selectedSignType === 1 && selectedDatabase != 0 && !loading" class="form-row">

			<div class="form-group col">
				<label for="area">Area</label>
				<select v-model="selectedArea" name="area" id="area" class="form-control @error('area') is-invalid @enderror">
					<option value="0" disabled>Select an Area</option>
					<option v-for="area in areas" v-bind:value="area.area_guid">
						@{{ area.description }}
					</option>
				</select>
				@error('area')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>

		</div>

		<div class="row">
			<div class="col">
				<button type="submit" class="btn btn-primary" v-bind:disabled="loading">Save</button>
			</div>
		</div>

	</form>

</div>

@endsection