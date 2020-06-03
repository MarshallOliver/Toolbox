@extends('layouts.signage')

@section('content')

<div id="sign" class="container-fluid p-5">
	<div class="row h-100">
		<div class="col">
			<div class="d-flex flex-column h-100">
				<div class="row no-gutters d-flex align-items-baseline mb-3">
					<div class="col">
						<img src="images/RoomCardLogo.png" />
					</div>
					<room-card-clock></room-card-clock>
				</div>
				<div class="row no-gutters flex-grow-1 event-table">
					<div class="col">
						<div class="d-flex flex-column h-100">
							<room-card-caption></room-card-caption>
							<div class="d-flex flex-column pt-4 pb-2 header">
								<div class="row no-gutters flex-grow-1 mx-5">
									<div class="col-2 pl-4 pb-2">Start</div>
									<div class="col-2 pl-4 pb-2">End</div>
									<div class="col-8 pl-4 pb-2">Event</div>
								</div>
							</div>
							<room-card-body></room-card-body>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection