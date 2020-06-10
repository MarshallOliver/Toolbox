<template>

	<div class="form-group col">
		<label for="location">Location</label>
		<select v-model="location" v-on:change="updateLocation" name="location" id="location" class="form-control" :class="{ 'is-invalid': $parent.errors.location }" v-bind:disabled="disabled">
			<option value="0" disabled>Select a Location</option>
			<option v-for="location in locations" v-bind:value="location.id">{{ location.long_name }}</option>
		</select>
		<slot></slot>
	</div>

</template>

<script>

	export default {

		data: function () {
			return {
				location: this.selectedLocation,

			}
		},

		props: {
			disabled: {
				type: Boolean,
				default: false,

			},

			selectedLocation: {
				type: Number,
				default: 0,

			},

			locations: Array,

		},

		methods: {
			updateLocation () {
				this.$emit('update:location', {id: this.location, databases: this.locationDatabases});

			},

			currentLocation (locations) {
				return locations.id == this.location;

			},

		},

		computed: {
			locationDatabases: function () {
				return this.locations.find(this.currentLocation).databases;

			},

		},

	}

</script>