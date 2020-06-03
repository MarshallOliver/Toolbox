<template>
	<div class="col clock text-right">
		<div class="row no-gutters pb-2">
			<div id="time" class="col time">{{ time }}</div>
		</div>
		<div class="row no-gutters">
			<div id="date" class="col date">{{ date }}</div>
		</div>
	</div>
</template>

<script>

	export default {
		data: function () {
			return {
				time: '',
				date: ''
			}
		},

		mounted() {
			this.loadClock();

		},

		methods: {
			loadClock () {

				const getClock = () => {
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
				}

				getClock();
				setInterval(getClock, 1000);
			}
		}
	}

</script>