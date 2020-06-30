<template>

<div class="d-flex flex-column h-100">
	
	<!-- Room Card Header -->
	<div class="row no-gutters d-flex align-items-baseline mb-3">

		<loading :active.sync="isLoading" :color="'#93C841'" :opacity="1" :background-color="'#000'" :is-full-page="true"></loading>

		<!-- Header Logo -->
		<div class="col">
			<img src="/images/RoomCardLogo.png" />
		</div>

		<!-- Header Date/Time -->
		<div class="col clock text-right">
			<div class="row no-gutters pb-2">
				<div id="time" class="col time"></div>
			</div>
			<div class="row no-gutters">
				<div id="date" class="col date"></div>
			</div>
		</div>

	</div>

	<!-- If there are no events scheduled for today, show a No Events message -->
	<div v-if="areaArrivals.length == 0" class="row no-gutters flex-grow-1 no-events">
		
		<div class="col">
			<div class="d-flex flex-column h-100">
	
				<!-- Today's Events caption -->
				<div class="row no-gutters caption px-5">
					<div class="col">
						<p class="text-uppercase">{{ areaDesc }}<span v-if="areaDec != ''"> | </span>TODAY'S EVENTS</p>
					</div>
				</div>

				<div class="row no-gutters text-center pt-5 mt-5 description-container">
					<div class="col description">
						There are currently no events scheduled in this room.
					</div>
				</div>

				<!-- No Events Footer -->
				<div class="row flex-grow-1 align-items-end no-gutters text-center">
					<div class="col footer">
						Contact group sales to have your event here.
					</div>
				</div>

			</div>
		</div>

	</div>

	<!-- Else if there is a current event, show the Current Event info -->
	<div v-else-if="hasCurrentEvent" class="row no-gutters flex-grow-1 current-event">

		<div class="col">
			<div class="d-flex flex-column h-100">

				<!-- Current Event Caption -->
				<div class="row no-gutters caption px-5">
					<div class="col">
						<p class="text-uppercase">{{ areaDesc }}<span v-if="areaDesc != ''"> | </span>EVENT CURRENTLY IN PROGRESS</p>
					</div>
				</div>

				<!-- Curent Event Description -->
				<div class="row no-gutters text-center pt-5 mt-5">
					<div class="col description">
						{{ nearestEvent[0].arrival.description }}
					</div>
				</div>

				<!-- Current Event Start and End Times -->
				<div class="row no-gutters text-center">
					<div class="col times">
						{{ nearestEvent[0].start_date_time | time }} - {{ nearestEvent[0].end_date_time | time }}
					</div>
				</div>

				<!-- Current Event Footer -->
				<div class="row flex-grow-1 align-items-end no-gutters text-center">
					<div class="col footer">
						Please be mindful of noise when entering and exiting event spaces.
					</div>
				</div>

			</div>
		</div>

	</div>

	<!-- Otherwise, show the Today's Events table -->
	<div v-else class="row no-gutters flex-grow-1 event-table">

		<div class="col">
			<div class="d-flex flex-column h-100">

				<!-- Event Table Caption -->
				<div class="row no-gutters caption px-5">
					<div class="col">
						<p class="text-uppercase">{{ areaDesc }}<span v-if="areaDesc != ''"> | </span>TODAY'S EVENTS</p>
					</div>
				</div>
				
				<!-- Event Table Header -->
				<div class="d-flex flex-column pt-4 pb-2 header">
					<div class="row no-gutters flex-grow-1 mx-5">
						<div class="col-2 pl-4 pb-2">Start</div>
						<div class="col-2 pl-4 pb-2">End</div>
						<div class="col-8 pl-4 pb-2">Event</div>
					</div>
				</div>
				
				<!-- Event Table Body -->
				<div class="d-flex flex-column flex-grow-1 pb-3 body">

					<!-- For each arrival in areaArrivals -->
					<div class="row no-gutters px-5" v-for="arrival in areaArrivals">
						<div class="col-2 pl-4 pb-4">{{ arrival.start_date_time | time }}</div>
						<div class="col-2 pl-4 pb-4">{{ arrival.end_date_time | time }}</div>
						<div class="col-8 pl-4 pb-4">{{ arrival.arrival.description }}</div>
					</div>

				</div>

			</div>
		</div>

	</div>

</div>

</template>

<script>

	import Loading from 'vue-loading-overlay';  // Vue Loading Overlay for preloader spinner
	import DebugMixin from 'mixins/DebugMixin';  // Custom debug mixin: includes debugLevel(valueToDisplay, numericalLevel) function
	import moment from 'moment';  // Moment.js Library for better datetime handling

	import 'vue-loading-overlay/dist/vue-loading.css';  // CSS for Loading

	export default {
		data: function () {
			return {
				isLoading: true,
				areaDesc: '',
				nearestEvent: [],
				areaArrivals: [],
				shiftDateTime: moment(),

			}
		},

		props: {
			roomCardArea: String,
			roomCardDatabase: Number,

		},

		computed: {
			hasCurrentEvent: function () {
				return this.nearestEvent.length == 0 ? false : moment().isBetween(moment(this.nearestEvent[0].start_date_time).subtract(15, 'minutes'), this.nearestEvent[0].end_date_time);

			},

			shiftDateStart: function () {
				return moment().set({
					'millisecond': this.shiftDateTime.millisecond(),
					'second': this.shiftDateTime.second(),
					'minute': this.shiftDateTime.minute(),
					'hour': this.shiftDateTime.hour()
				});

			},

			shiftDateEnd: function () {
				return moment().set({
					'millisecond': this.shiftDateTime.millisecond(),
					'second': this.shiftDateTime.second(),
					'minute': this.shiftDateTime.minute(),
					'hour': this.shiftDateTime.hour(),
					'date': moment().date() + 1
				});
			}

		},

		methods: {
			getShiftDate: function () {
				
				let uri = '/api/catalog/' + this.roomCardDatabase + '/application';
				let fields = 'fields=shift_date_change_time';

				return axios.get(uri + '?' + fields)
				.then((response) => {
					this.shiftDateTime = moment(response.data.data.shift_date_change_time);
					this.debugLevel([
						'shiftDateTime successfully loaded: ' + moment().format('YYYY-MM-DD HH:mm:ss'), 
						'shiftDateStart: ' + this.shiftDateStart.format('YYYY-MM-DD HH:mm:ss'), 
						'shiftDateEnd: ' + this.shiftDateEnd.format('YYYY-MM-DD HH:mm:ss')
					]);
				})
				.catch((error) => {
					this.debugLevel(['Error in loadShiftDateTime: ' + moment().format('YYYY-MM-DD HH:mm:ss'), uri + fields, error]);
				});

			},

			getAreaDesc: function () {

				let uri = '/api/catalog/' + this.roomCardDatabase + '/areas/' + this.roomCardArea;

				return axios.get(uri)
				.then((response) => {
					this.areaDesc = response.data.data.description;
					this.debugLevel(['areaDesc successfully loaded: ' + moment().format('YYYY-MM-DD HH:mm:ss'), this.areaDesc]);
				})
				.catch((error) => {
					this.debugLevel(['Error in loadAreaDesc: ' + moment().format('YYYY-MM-DD HH:mm:ss'), uri, error]);
				});

			},

			getAreaArrivals: function () {

				let uri = '/api/catalog/' + this.roomCardDatabase + '/bookings';
				let filters = 'filter[bookings][area_guid][e]=' + this.roomCardArea +'&filter[bookings][start_date_time][gte]=' + this.shiftDateStart.format('YYYY-MM-DD HH:mm:ss') + '&filter[bookings][end_date_time][lte]=' + this.shiftDateEnd.format('YYYY-MM-DD HH:mm:ss');
				let limit = 'limit[bookings]=12';

				return axios.get(uri + '?' + filters + '&' + limit)
				.then((response) => {
					this.areaArrivals = response.data.data;
					this.debugLevel(['areaArrivals successfully loaded: ' + moment().format('YYYY-MM-DD HH:mm:ss'), this.areaArrivals]);
				})
				.catch((error) => {
					this.debugLevel(['Error in getAreaArrivals: ' + moment().format('YYYY-MM-DD HH:mm:ss'), uri + '?' + filters + '&' + limit, error]);
				});

			},

			getNearestEvent: function () {

				let uri = '/api/catalog/' + this.roomCardDatabase + '/bookings';
				let filters = 'filter[bookings][area_guid][e]=' + this.roomCardArea + '&filter[bookings][end_date_time][gte]=' + moment().format('YYYY-MM-DD HH:mm:ss');
				let limit = 'limit[bookings]=1';

				return axios.get(uri + '?' + filters + '&' + limit)
				.then((response) => {
					this.nearestEvent = response.data.data;
					this.debugLevel(['nearestEvent successfully loaded: ' + moment().format('YYYY-MM-DD HH:mm:ss'), this.nearestEvent]);
				})
				.catch((error) => {
					this.debugLevel(['Error in getNearestEvent: ' + moment().format('YYYY-MM-DD HH:mm:ss'), uri + '?' + filters + '&' + limit, error]);
				});

			},

			getClock: function () {
				document.getElementById('time').innerHTML = moment().format('H:mm A');
				document.getElementById('date').innerHTML = moment().format('M/D/YYYY');

			},

		},
		
		filters: {
			time: function (value) {
				return moment(value).format('H:mm A');
			}

		},

		mounted: async function () {
			this.getClock();
			setInterval(this.getClock, 1000);

			await this.getAreaDesc();

			await this.getShiftDate();
			setInterval(this.getShiftDate, 300000);

			await this.getNearestEvent();
			setInterval(this.getNearestEvent, 300000);

			await this.getAreaArrivals();
			setInterval(this.getAreaArrivals, 300000);

			this.isLoading = false;

		},

		components: {
			Loading
		},

		mixins: [DebugMixin],

	}

</script>