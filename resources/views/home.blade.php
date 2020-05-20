@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="section">
	<div class="container">

		<h1 class="title">Welcome to Toolbox</h1>
		<p class="subtitle">
			A collection of tools for manipulating <a href="http://www.centeredgesoftware.com/" target="#">CenterEdge Software</a> data and simplifying other tasks common in the <strong>Family Entertainment</strong> industry
		</p>

		<h2>Select a tool:</h2>
		<ul>
			<li><a href="/dpl">DPL Generator</a></li>
			<li><a href="/signage">Signage</a></li>
		</ul>

	</div>
</div>

@endsection