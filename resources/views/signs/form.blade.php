@extends('layouts.form')

@section('fields')

	<form-base-row>
		<form-base-input type="text" name="name" id="name" placeholder="Enter a Description" value="{{ $sign->name ?? '' }}" class="col" required>
			Description
		</form-base-input>
	</form-base-row>

	<form-base-row>
		<form-base-select name="location" id="location" :form-options="{ options: {{ $locations }}, keyBy: 'id', listBy: 'long_name' }" value="{{ $sign->database->location->id ?? '' }}" class="col" required>
			Location
		</form-base-select>
		<form-base-select name="database" id="database" :form-options="{ options: {{ $databases }}, keyBy: 'id', listBy: 'catalog', filterBy: 'location_id', filterValue: '{{ $sign->database->location->id ?? '' }}' }" value="{{ $sign->database_id ?? '' }}" class="col" required>
			Database
		</form-base-select>
	</form-base-row>

	<form-sign-builder :sign-types="{{ $signTypes }}" :form-options="{ selectedType: '{{ $sign->signType->id ?? '' }}', selectedArea: '{{ $sign->signArea->area_guid ?? '' }}', selectedDatabase: '{{ $sign->database_id ?? '' }}' }"></form-sign-builder>

	<form-base-row>
		<form-base-submit class="col" :is-primary="true" cancel-action="/signs">Save</form-base-submit>
	</form-base-row>

@endsection