@extends('layouts.main')

@section('title', 'Locations')

@section('content')

<div class="section">
	<div class="container">

		<h1 class="title">Add a Database</h1>

		<form action="/locations/{{ $location }}/databases/{{ $database->id }}" method="POST">

			@csrf

			@method('PUT')

			<div class="columns">
				<div class="column">
					<div class="field">
						<label class="label">Host</label>
						<div class="control">
							<input name ="host" class="input @error('host') is-danger @enderror" type="text" value="{{ $database->host }}" required>
						</div>
						@error('host')
							<p class="help is-danger">{{ $message }}</p>
						@enderror
					</div>
				</div>

				<div class="column is-one-quarter">

					<div class="field">
						<label class="label">Port</label>
						<div class="control">
							<input name="port" class="input @error('port') is-danger @enderror" type="text" pattern="\d+" value="{{ $database->port }}" required>
						</div>
						@error('port')
							<p class="help is-danger">{{ $message }}</p>
						@enderror
					</div>
				</div>
			</div>

			<div class="field">
				<label class="label">Catalog</label>
				<div class="control">
					<input name="catalog" class="input @error('catalog') is-danger @enderror" type="text" value="{{ $database->catalog }}" required>
				</div>
				@error('catalog')
					<p class="help is-danger">{{ $message }}</p>
				@enderror
			</div>

			<div class="field">
				<label class="label">Username</label>
				<div class="control">
					<input name="username" class="input @error('username') is-danger @enderror" type="text" value="{{ $database->username }}" required>
				</div>
				@error('username')
					<p class="help is-danger">{{ $message }}</p>
				@enderror
			</div>

			<div class="columns">
				<div class="column">

					<div class="field">
						<label class="label">Password</label>
						<div class="control">
							<input name="password" class="input @error('password') is-danger @enderror" type="password" value="{{ $database->password }}" required>
						</div>
						@error('password')
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
					<a href="/locations/{{ $location }}/edit" class="button is-light">Cancel</a>
				</div>
			</div>

		</form>

	</div>
</div>
	
@endsection