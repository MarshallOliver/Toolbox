@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>{{ __('Add a Sign') }}</h1>
		</div>
	</div>

	@include('signs.form', ['action' => '/signs', 'method' => 'POST'])

</div>

@endsection