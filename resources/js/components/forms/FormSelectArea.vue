<template>

	<div class="form-group col">
		<label for="area">Area</label>
		<select v-model="area" v-on:change="updateArea" name="area" id="area" class="form-control" :class="{ 'is-invalid': $parent.errors.area }" v-bind:disabled="disabled">
			<option value="" disabled>Select an Area</option>
			<option v-for="area in areas" v-bind:value="area.area_guid">{{ area.description }}</option>
		</select>
		<slot></slot>
	</div>

</template>

<script>

	export default {
		data: function () {
			return {
				area: this.selectedArea,
			}
		},

		props: {
			disabled: {
				type: Boolean,
				default: false,
			},

			selectedArea: {
				type: String,
				default: '',
			},

			areas: Array,
		},

		methods: {
			updateArea: function () {
				this.$emit('update:area', this.area);
			}
		}


	}

</script>