<template>

	<div class="form-group col">
		<label for="sign_type">Sign Type</label>
		<select v-model="signType" v-on:change="updateSignType" name="sign_type" id="sign_type" class="form-control" :class="{ 'is-invalid': $parent.errors.sign_type }" v-bind:disabled="disabled">
			<option value="0" disabled>Select a Sign Type</option>
			<option v-for="signType in signTypes" v-bind:value="signType.id">{{ signType.name }}</option>
		</select>
		<slot></slot>
	</div>

</template>

<script>

	export default {
		data: function () {
			return {
				signType: this.selectedSignType,

			}
		},

		props: {
			disabled: {
				type: Boolean,
				default: false,

			},

			selectedSignType: {
				type: Number,
				default: 0,

			},

			signTypes: Array,

		},

		watch: {
			selectedSignType: function () {
				this.signType = this.selectedSignType;
			},

		},

		methods: {
			updateSignType () {
				this.$emit('update:sign-type', this.signType);

			},
		}

	}

</script>