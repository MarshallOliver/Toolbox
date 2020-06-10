@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>{{ __('Edit a Sign') }}</h1>
		</div>
	</div>

	<sign-form

		:action="'/signs/{{ $sign->id }}'"
		:method="'update'"
		:errors="{{ $errors }}"
		:locations="{{ $locations }}"
		:sign-types="{{ $signTypes }}"

		:selected-description="'{{ $sign->name }}'"
		:selected-location="{{ $sign->database->location->id }}"
		:selected-databases="{{ $sign->database->location->databases }}"
		:selected-database="{{ $sign->database->id }}"
		:selected-sign-type="{{ $sign->signType->id }}"
		:selected-area="'{{ $sign->signArea->area_guid ?? '' }}'">
			
	</sign-form>

</div>

@endsection