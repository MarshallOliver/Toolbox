@extends('layouts.app')

@section('content')

	<message-log :log-location="{{ $location }}" :log-database="{{ $database }}"></message-log>

@endsection