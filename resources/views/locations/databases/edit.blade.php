@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>{{ __('Edit') }} {{ $database->location->long_name }} - {{ $database->catalog }}</h1>
		</div>
	</div>
	
	@include('locations.databases.form', ['action' => '/locations/' . $location->id . '/databases/' . $database->id, 'method' => 'PUT'])

</div>

@endsection