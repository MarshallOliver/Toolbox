@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>{{ __('Edit') }} {{ $sign->name }}</h1>
		</div>
	</div>

	@include('signs.form', ['action' => '/signs/' . $sign->id, 'method' => 'PUT'])

</div>

@endsection