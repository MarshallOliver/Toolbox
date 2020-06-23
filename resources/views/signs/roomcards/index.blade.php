@extends('layouts.signage')

@section('content')

	<div id="sign" class="container-fluid p-5">
		<div class="row h-100">
			<div class="col">

				<sign-room-card

					:room-card-area="'{{ $sign->signArea->area_guid }}'"
					:room-card-database="{{ $sign->database_id }}">
						
				</sign-room-card>

			</div>
		</div>
	</div>

@endsection