@extends('layouts.app')

@section('content')

	<div class="container">

		<div class="row">
			<div class="col">
				<h1>{{ __('Add a Location') }}</h1>
			</div>
		</div>

		<div class="row">
			<div class="col">

				@include('locations.form', ['action' => '/locations', 'method' => 'POST'])

			</div>

		</div>

	</div>

@endsection