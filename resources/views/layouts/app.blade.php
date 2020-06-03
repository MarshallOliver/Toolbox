@extends('layouts.base')

@section('body')
@include('includes.navbar')
<main class="py-4">
    @yield('content')
</main>
@endsection