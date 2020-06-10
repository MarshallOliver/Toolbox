<template>
<div class="d-flex flex-column flex-grow-1 pb-3 body">
	<div class="row no-gutters px-5" v-for="arrival in arrivals">
		<div class="col-2 pl-4 pb-4">{{ arrival.group_area_bookings.start_date_time | time }}</div>
		<div class="col-2 pl-4 pb-4">{{ arrival.group_area_bookings.end_date_time | time }}</div>
		<div class="col-8 pl-4 pb-4">{{ arrival.description }}</div>
	</div>
</div>
</template>

<script>
	
	export default {
		data: function () {
			return {
				arrivals: [],

			}
		},

		mounted() {
			this.loadArrivals();
		},

		props: {
			roomCardArea: String,
			database: Number,
		},

		methods: {
			loadArrivals: function () {

				const getArrivals = () => {

					const today = new Date();
					const tomorrow = new Date();

					tomorrow.setDate(today.getDate() + 1);

					axios.get('/api/catalog/' + this.database + '/areas/' + this.roomCardArea + '/arrivals?limit[arrivals]=12&filter[start_date_time][gte]=' + today.toLocaleDateString() +'%2004:00:00&filter[end_date_time][lte]=' + tomorrow.toLocaleDateString() + '%2004:00:00')
					.then((response) => {
						this.arrivals = response.data.data.arrivals;
					})
					.catch(function (error) {
						console.log(error);
					});
				}

				getArrivals();
				setInterval(getArrivals, 5000);
			
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
	}

</script>