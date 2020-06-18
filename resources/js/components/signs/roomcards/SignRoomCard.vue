<template>

	<div class="d-flex flex-column h-100">
		<div class="row no-gutters d-flex align-items-baseline mb-3">

			<loading :active.sync="isLoading" :color="'#93C841'" :opacity="1" :background-color="'#000'" :is-full-page="true"></loading>

			<div class="col">
				<img src="/images/RoomCardLogo.png" />
			</div>
			<div class="col clock text-right">
				<div class="row no-gutters pb-2">
					<div id="time" class="col time"></div>
				</div>
				<div class="row no-gutters">
					<div id="date" class="col date"></div>
				</div>
			</div>
		</div>
		<div class="row no-gutters flex-grow-1 event-table">
			<div class="col">
				<div class="d-flex flex-column h-100">
					
					<div v-if="hasCurrentEvent" class="row no-gutters caption px-5">
						<div v-if="areaDescFailed" class="col">
							<p class="text-uppercase">EVENT CURRENTLY IN PROGRESS</p>
						</div>
						<div v-else class="col">
							<p class="text-uppercase">{{ areaDesc }}<span> | </span>EVENT CURRENTLY IN PROGRESS</p>
						</div>
					</div>

					<div v-else class="row no-gutters caption px-5">
						<div v-if="areaDescFailed" class="col">
							<p class="text-uppercase">TODAY'S EVENTS</p>
						</div>
						<div v-else class="col">
							<p class="text-uppercase">{{ areaDesc }}<span> | </span>TODAY'S EVENTS</p>
						</div>
					</div>
					
					<div class="d-flex flex-column pt-4 pb-2 header">
						<div class="row no-gutters flex-grow-1 mx-5">
							<div class="col-2 pl-4 pb-2">Start</div>
							<div class="col-2 pl-4 pb-2">End</div>
							<div class="col-8 pl-4 pb-2">Event</div>
						</div>
					</div>
					
					<div class="d-flex flex-column flex-grow-1 pb-3 body">
						<div class="row no-gutters px-5" v-for="arrival in areaArrivals">
							<div class="col-2 pl-4 pb-4">{{ arrival.group_area_bookings.start_date_time | time }}</div>
							<div class="col-2 pl-4 pb-4">{{ arrival.group_area_bookings.end_date_time | time }}</div>
							<div class="col-8 pl-4 pb-4">{{ arrival.description }}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</template>

<script>

	import Loading from 'vue-loading-overlay';

	import 'vue-loading-overlay/dist/vue-loading.css';

	export default {
		data: function () {
			return {
				areaDesc: '',
				areaArrivals: [],
				nearestEvent: [],
				isLoadingArrivals: true,
				isLoadingArea: true,	

			}
		},

		props: {
			roomCardArea: {
				type: String,
				default: '',

			},

			roomCardDatabase: {
				type: Number,
				default: 0,

			},

		},

		computed: {
			isLoading: function () {
				return (this.isLoadingArea || this.isLoadingArrivals);

			},

			today: function () {
				return this.now().toLocaleDateString();
			
			},

			tomorrow: function () {
				return new Date((new Date()).setDate(this.now().getDate() + 1)).toLocaleDateString();

			},

			areaDescFailed: function () {
				return this.areaDesc == '';
			
			},

			currentDateTimeStamp: function () {
				return this.now().toLocaleDateString() + '%20' + this.now().getHours() + ':' + this.now().getMinutes() + ':00';

			},

			hasCurrentEvent: function () {

				if (this.nearestEvent.group_area_bookings) {
					
					let nearestEventStartDateTime = new Date(this.nearestEvent.group_area_bookings.start_date_time);
					let nearestEventEndDateTime = new Date(this.nearestEvent.group_area_bookings.end_date_time);

					return (nearestEventStartDateTime <= this.now && nearestEventEndDateTime >= this.now);

				}

			},

		},

		filters: {
			time: function (value) {
				let date = new Date(value);
				let hours = date.getHours();
				let minutes = date.getMinutes();

				let ampm = hours >= 12 ? 'PM' : 'AM';

				hours = hours % 12;
				hours = hours ? hours : 12;

				minutes = minutes < 10 ? '0' + minutes : minutes;

				return hours + ':' + minutes + ' ' + ampm;
			}

		},

		methods: {
			loadClock: function () {

				let dt = new Date();
				let nhour = dt.getHours(), nmin=dt.getMinutes(),ap;
				if (nhour < 12) {
					ap = " AM";
				} else if (nhour == 12) {
					ap = " PM";
				} else if (nhour > 12) {
					ap = " PM";
					nhour -= 12;
				}

				if (nmin <= 9) {
					nmin = "0" + nmin;
				}

				let clockText = "" + nhour + ":" + nmin + ap + "";

				document.getElementById('time').innerHTML = clockText;
				document.getElementById('date').innerHTML = dt.toLocaleDateString();

			},

			loadAreaDesc: function () {
				axios.get('/api/catalog/' + this.roomCardDatabase + '/areas/' + this.roomCardArea)
				.then((response) => {
					this.areaDesc = response.data.data.description;
					this.isLoadingArea = false;
				})
				.catch((error) => {
					console.log('Error in loadAreaDesc: '+ this.now());
					console.log(error);
					this.isLoadingArea = false;
				});

			},

			loadAreaArrivals: function () {
				axios.get('/api/catalog/' + this.roomCardDatabase + '/areas/' + this.roomCardArea + '/arrivals?limit[arrivals]=12&filter[start_date_time][gte]=' + this.today +'%2004:00:00&filter[end_date_time][lte]=' + this.today + '%2009:32:00')
				.then((response) => {
					this.areaArrivals = response.data.data.arrivals;
					this.isLoadingArrivals = false;
				})
				.catch((error) => {
					console.log('Error in loadAreaArrivals: '+ this.now());
					console.log(error);
					this.isLoadingArrivals = false;
				});

			},

			loadNearestEvent: function () {
				axios.get('/api/catalog/' + this.roomCardDatabase + '/areas/' + this.roomCardArea + '/arrivals?limit[arrivals]=1&filter[end_date_time][gte]=' + this.currentDateTimeStamp)
				.then((response) => {
					this.nearestEvent = response.data.data.arrivals[0];
					this.isLoadingNearestEvent = false;
				})
				.catch((error) => {
					console.log('Error in loadNearestEvent: '+ this.now());
					console.log(error);
					this.isLoadingNearestEvent = false;
				});
			},

			now: function () {
				return new Date();
			},

		},

		mounted: function () {

			this.loadClock();
			setInterval(this.loadClock, 1000);

			this.loadAreaDesc();
			setInterval(this.loadAreaDesc, 300000);

			this.loadAreaArrivals();
			setInterval(this.loadAreaArrivals, 300000);

			this.loadNearestEvent();
			setInterval(this.loadNearestEvent, 300000);

		},

		components: {
			Loading

		},

	}

</script>