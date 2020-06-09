<template>
<div class="row no-gutters caption px-5">
	<div class="col">
		<p>{{ area }}<span> | </span>TODAY'S EVENTS</p>
	</div>
</div>
</template>

<script>

	export default {
		data: function () {
			return {
				area: ''
			}
		},

		props: {
			roomCardArea: String,
			database: Number,
		},

		mounted() {
			this.loadArea();
		},

		methods: {
			loadArea: function () {
				axios.get('/api/catalog/' + this.database + '/areas/' + this.roomCardArea)
				.then((response) => {
					this.area = response.data.data.description;
				})
				.catch(function (error) {
					console.log(error);
				});
			},
		}
	}


</script>