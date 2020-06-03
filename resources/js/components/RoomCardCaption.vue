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

		mounted() {
			this.loadArea();
		},

		methods: {
			loadArea: function () {
				axios.get('/api/catalog/12/areas/46B15117-3080-44B8-BDEA-09574909B068')
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