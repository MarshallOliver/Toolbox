<form-base form-action="{{ $action }}" form-method="{{ $method }}" :form-errors="{{ $errors->toJson() }}">

	@yield('fields')

</form-base>