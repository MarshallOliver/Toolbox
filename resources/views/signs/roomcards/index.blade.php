@extends('layouts.signage')

@section('content')

<div id="sign" class="container-fluid p-5">
	<div class="row h-100">
		<div class="col">
			<div class="d-flex flex-column h-100">
				<div class="row no-gutters d-flex align-items-baseline mb-3">
					<div class="col">
						<img src="/images/RoomCardLogo.png" />
					</div>
					<sign-room-card-clock></sign-room-card-clock>
				</div>
				<div class="row no-gutters flex-grow-1 event-table">
					<div class="col">
						<div class="d-flex flex-column h-100">
							
							<sign-room-card-caption 

								v-bind:room-card-area="'{{ $sign->signArea->area_guid }}'" 
								v-bind:database="{{ $sign->database_id }}">
									
							</sign-room-card-caption>
							
							<div class="d-flex flex-column pt-4 pb-2 header">
								<div class="row no-gutters flex-grow-1 mx-5">
									<div class="col-2 pl-4 pb-2">Start</div>
									<div class="col-2 pl-4 pb-2">End</div>
									<div class="col-8 pl-4 pb-2">Event</div>
								</div>
							</div>
							
							<sign-room-card-body 

								v-bind:room-card-area="'{{ $sign->signArea->area_guid }}'" 
								v-bind:database="{{ $sign->database_id }}">

							</sign-room-card-body>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection