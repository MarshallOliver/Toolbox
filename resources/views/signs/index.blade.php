@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">

			<h1>{{ __('Signs') }}</h1>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">Sign</th>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($signs as $sign)
						<tr>
							<td>{{ $sign->name }}</td>
							<td><a href="/signs/{{ $sign->id }}/edit">Edit</a></td>
							<td><a href="#" onclick="confirmDeleteSign({{ $sign->id }}, '{{ $sign->name }}')">Delete</i></a></td>
						</tr>						
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
	
	<div class="row">
		<div class="col">

			<a href="/signs/create" class="btn btn-primary">New</a>

		</div>
	</div>

</div>

<div id="deleteSign" class="modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Delete <span class="deleteName"></span>?</h5>
				<button type="button" class="close" onclick="closeConfirmDeleteSign()" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to <span class="text-danger font-weight-bold">DELETE</span> the <u class="deleteName"></u> sign?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="closeConfirmDeleteSign()">Cancel</button>
				<form id="deleteSignForm" action="" method="POST">
	
					@csrf
	
					@method('delete') 

					<button type="submit" class="btn btn-danger">Delete</button>

				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('postscript')

<script>
	
	function confirmDeleteSign(id, name) {
		$(".deleteName").html(name);
		document.getElementById("deleteSignForm").action = '/signs/' + id;

		$('#deleteSign').modal('toggle');
	}

	function closeConfirmDeleteSign() {

		$('#deleteSign').modal('toggle');

	}

</script>

@endsection