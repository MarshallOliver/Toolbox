@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">

			<h1>{{ __('Button Updates') }}</h1>

		</div>
	</div>

	<form-base form-action="/button-updates" form-method="POST" :form-errors="{{ $errors->toJson() }}">
			
		<form-base-row>
			<form-base-select name="location" id="location" :form-options="{ options: {{ $locations }}, keyBy: 'id', listBy: 'long_name' }" value="{{ $sign->database->location->id ?? '' }}" class="col" required>
				Location
			</form-base-select>
			<form-base-select name="database" id="database" :form-options="{ options: {{ $databases }}, keyBy: 'id', listBy: 'catalog', filterBy: 'location_id', filterValue: '{{ $sign->database->location->id ?? '' }}' }" value="{{ $sign->database_id ?? '' }}" class="col" required>
				Database
			</form-base-select>
		</form-base-row>

		<form-base-row>
			<form-base-submit class="col" :is-danger="true" cancel-action="/home">Execute</form-base-submit>
		</form-base-row>

	</form-base>
	
</div>

@endsection