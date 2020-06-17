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
					
					<div class="row no-gutters caption px-5">
						<div v-if="areaDescFailed" class="col">
							<p>TODAY'S EVENTS</p>
						</div>
						<div v-else class="col">
							<p>{{ areaDesc }}<span> | </span>TODAY'S EVENTS</p>
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
				areaArrivalsLoaded: false,
				areaDscLoaded: false,

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
				return !this.areaDescLoaded && !this.areaArrivalsLoaded;

			},

			today: function () {
				return new Date();
			
			},

			tomorrow: function () {
				return new Date((new Date()).setDate(this.today.getDate() + 1));

			},

			areaDescFailed: function () {
				return this.areaDesc == '';
			}

		},

		filters: {
			time: function (value) {
				if (!value) return '';
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

				let app = this;

				axios.get('/api/catalog/' + this.roomCardDatabase + '/areas/' + this.roomCardArea)
				.then((response) => {
					this.areaDesc = response.data.data.description;
					this.areaDescLoaded = true;
				})
				.catch((error) => {
					this.areaDesc = '';
					console.log(error);
					this.areaDescLoaded = true;
				});

			},

			loadAreaArrivals: function () {
				axios.get('/api/catalog/' + this.roomCardDatabase + '/areas/' + this.roomCardArea + '/arrivals?limit[arrivals]=12&filter[start_date_time][gte]=' + this.today.toLocaleDateString() +'%2004:00:00&filter[end_date_time][lte]=' + this.tomorrow.toLocaleDateString() + '%2004:00:00')
				.then((response) => {
					this.areaArrivals = response.data.data.arrivals;
					this.areaArrivalsLoaded = true;
				})
				.catch(function (error) {
					console.log(error);
					this.areaArrivalsLoaded = true;
				});

			},

		},

		mounted: function () {

			this.loadClock();
			setInterval(this.loadClock, 1000);

			this.loadAreaDesc();
			setInterval(this.loadAreaDesc, 300000);

			this.loadAreaArrivals();
			setInterval(this.loadAreaArrivals, 300000);
		
		},

		components: {
			Loading

		},

	}

</script>