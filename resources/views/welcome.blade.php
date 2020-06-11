@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col">
			<h1>Welcome to Toolbox</h1>
		</div>
    </div>
    <div class="row">
    	<div class="col">
    		<p class="lead">
				A collection of tools for manipulating <a href="http://centeredgesoftware.com" target="#">CenterEdge Software</a> data and simplifying other common tasks in the <strong>Family Entertainment</strong> industry. Test...
			</p>
    	</div>
    </div>
    <div class="row">
    	<div class="col">
    		<div class="row">
    			<div class="col">
					<a href="/dpl">DPL Generator</a>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<span class="small">Quickly generate missing DPLs to expedite the inventory receipt process.</span>
				</div>
			</div>
    	</div>
    </div>
</div>
@endsection
