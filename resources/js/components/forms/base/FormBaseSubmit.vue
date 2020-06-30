<template>

	<div class="from-group">
		<button v-bind="$attrs" type="submit" class="btn" :class="{ 'btn-primary': isPrimary, 'btn-danger': isDanger }"><slot>Submit</slot></button>
		<a :href="cancelAction" class="btn btn-secondary"><slot name="cancel">Cancel</slot></a>
	</div>

</template>

<script>

	export default {
		inheritAttrs: false,

		props: {
			isPrimary: {
				type: Boolean,
				default: false,

			},

			isDanger: {
				type: Boolean,
				default: false,

			},

			onClick: {
				type: String,
				default: null,

			},

			cancelAction: {
				type: String,
				default: '',
			
			},

		},

	}

</script>