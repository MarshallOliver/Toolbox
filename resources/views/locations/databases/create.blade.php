@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>{{ __('Add a Database') }}</h1>
		</div>
	</div>
	
	@include('locations.databases.form', ['action' => '/locations/' . $location->id . '/databases', 'method' => 'POST'])

</div>

@endsection