<template>
<div class="d-flex flex-column flex-grow-1 pb-3 body">
	<div class="row no-gutters px-5" v-for="arrival in arrivals">
		<div class="col-2 pl-4 pb-4">{{ arrival.booking_details.start_date_time | time }}</div>
		<div class="col-2 pl-4 pb-4">{{ arrival.booking_details.end_date_time | time }}</div>
		<div class="col-8 pl-4 pb-4">{{ arrival.description }}</div>
	</div>
</div>
</template>

<script>
	
	export default {
		data: function () {
			return {
				arrivals: []
			}
		},

		mounted() {
			this.loadArrivals();
		},

		methods: {
			loadArrivals: function () {
				axios.get('/api/catalog/12/areas/46B15117-3080-44B8-BDEA-09574909B068/arrivals?limit[arrivals]=12')
				.then((response) => {
					this.arrivals = response.data.data.arrivals;
				})
				.catch(function (error) {
					console.log(error);
				});
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