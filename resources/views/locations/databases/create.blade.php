@extends('layouts.main')

@section('title', 'Locations')

@section('content')

<div class="section">
	<div class="container">

		<h1 class="title">Add a Database</h1>

		<form action="/locations/{{ $location }}/databases" method="POST">

			@csrf

			<div class="columns">
				<div class="column">
					<div class="field">
						<label class="label">Host</label>
						<div class="control">
							<input name ="host" class="input @error('host') is-danger @enderror" type="text" placeholder="127.0.0.1" required>
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
							<input name="port" class="input @error('port') is-danger @enderror" type="text" pattern="\d+" placeholder="1433" required>
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
					<input name="catalog" class="input @error('catalog') is-danger @enderror" type="text" placeholder="CenterEdge" required>
				</div>
				@error('catalog')
					<p class="help is-danger">{{ $message }}</p>
				@enderror
			</div>

			<div class="field">
				<label class="label">Username</label>
				<div class="control">
					<input name="username" class="input @error('username') is-danger @enderror" type="text" required>
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
							<input name="password" class="input @error('password') is-danger @enderror" type="password" required>
						</div>
						@error('password')
							<p class="help is-danger">{{ $message }}</p>
						@enderror
					</div>

				</div>

			</div>

			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button type="submit" class="button is-primary">Submit</button>
				</div>
				<div class="control">
					<a href="/locations/{{ $location }}/edit" class="button is-light">Cancel</a>
				</div>
			</div>

		</form>

	</div>
</div>
	
@endsection