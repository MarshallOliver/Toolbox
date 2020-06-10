@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>{{ __('Add a Sign') }}</h1>
		</div>
	</div>
	
	<sign-form

		:action="'/signs'"
		:method="'store'"
		:errors="{{ json_encode($errors->toArray()) }}"
		:locations="{{ $locations }}"
		:sign-types="{{ $signTypes }}"

	></sign-form>

</div>

@endsection