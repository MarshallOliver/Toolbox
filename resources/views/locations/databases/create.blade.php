@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>{{ __('Add a Database') }}</h1>
		</div>
	</div>
	<form action="/locations/{{ $location->id }}/databases" method="POST">

		@csrf

		<div class="form-row">
			<div class="form-group col">
				<label for="host">Host</label>
				<input type="text" name="host" class="form-control @error('host') is-invalid @enderror" id="host" required>
				@error('host')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="form-group col">
				<label for="catalog">Catalog</label>
				<input type="text" name="catalog" class="form-control @error('port') is-invalid @enderror" id="catalog" required>
				@error('catalog')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
			<div class="form-group col-2">
				<label for="port">Port</label>
				<input type="text" pattern="\d+" name="port" class="form-control @error('port') is-invalid @enderror" id="port" required>
				@error('host')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
		
		</div>
		<div class="form-row">
			<div class="form-group col">
				<label for="username">Username</label>
				<input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" required>
				@error('username')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col">
				<label for="passowrd">Password</label>
				<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
				@error('password')
					<div class="invalid-feedback">
						{{ $message }}
					</div>
				@enderror
			</div>
		</div>

		<div class="row">
			<div class="col">
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
		</div>

	</form>

</div>

@endsection